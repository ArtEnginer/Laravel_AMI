<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\AuditPlan;
use App\Models\Bukti;
use App\Models\Rekomendasi;
use App\Models\Standard;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            if ($request->query('action') == "plans") {
                $q = AuditPlan::with('faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2')
                    ->where('study_program_id', '=', $user->id);
                $q = $request->query('year') == "none" ? $q : $q->where('tahun', '=', $request->query('year'));
                return json_encode($q->get());
            }
            if ($request->query('action') == "audit") {
                $standards = Standard::with('pertanyaan')
                    ->get()->toArray();
                array_walk($standards, function (&$value, $key, $request) {
                    $value['bukti'] = Bukti::where('audit_plan_id', '=', 1)->where('standard_id', '=', $value['id'])->first();
                    $value['nilai'] = Audit::where('audit_plan_id', '=', $request->query('plan_id'))
                        ->where('standard_id', '=', $value['id'])->first();
                    $value['rekomendasi'] = Rekomendasi::where('audit_plan_id', '=', $request->query('plan_id'))
                        ->where('standard_id', '=', $value['id'])->first();
                }, $request);
                return json_encode($standards);
            }
            return json_encode([]);
        }
        $tahun = Tahun::get();
        $data = AuditPlan::with('faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2')
            ->where('study_program_id', '=', $user->id)
            ->get();
        return view('pages.standarpertanyaan.index', compact('data', 'user', 'tahun'));
    }

    public function create_bukti($id, $sid)
    {
        return view('pages.standarpertanyaan.create_bukti', compact('id'));
    }

    public function store_bukti(Request $request, $id, $sid)
    {

        // Simpan informasi file ke dalam model "Bukti"
        $bukti = new Bukti();
        $bukti->audit_plan_id = $id;
        $bukti->standard_id = $sid;
        $bukti->user_id = Auth::id();
        $bukti->value = $request->bukti;
        // Tambahkan kolom lain yang sesuai
        $bukti->save();

        return redirect()->route('standarpertanyaan.index')->with('message', 'Bukti berhasil ditambahkan.');

    }

    public function laporan_ami(Request $request)
    {
        $tahun = Tahun::get();
        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->whereYear('created_at', $selectedYear)
                ->get();
        } else {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->get();
        };
        return view('pages.laporan-prodi.laporan_ami', compact('data', 'tahun'));
    }

    public function laporan_ketercapaian(Request $request)
    {
        $tahun = Tahun::get();
        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->whereYear('created_at', $selectedYear)
                ->get();
        } else {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->get();
        };

        return view('pages.laporan-prodi.laporan_ketercapaian', compact('data', 'tahun'));
    }

    public function laporan_temuan_ringan(Request $request)
    {
        $tahun = Tahun::get();
        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->whereYear('created_at', $selectedYear)
                ->get();
        } else {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->get();
        };

        return view('pages.laporan-prodi.laporan_ringan', compact('data', 'tahun'));
    }

    public function laporan_temuan_berat(Request $request)
    {
        $tahun = Tahun::get();
        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->whereYear('created_at', $selectedYear)
                ->get();
        } else {
            $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
                ->get();
        };

        return view('pages.laporan-prodi.laporan_berat', compact('data', 'tahun'));
    }

    public function print(Request $request, $type) {
        $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
            ->get();

        return view('pages.laporan-prodi.print', compact('data', 'type'));
    }
}
