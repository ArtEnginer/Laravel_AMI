<?php

namespace App\Http\Controllers;

use App\Models\AuditPlan;
use App\Models\Rekomendasi;
use App\Models\Standard;
use App\Models\Tahun;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tahun = Tahun::get();
        $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
            ->get();
        $plans = AuditPlan::with('faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2')
            ->where('lead_auditor_id', '=', Auth::id())
            ->orWhere('auditor_2_id', '=', Auth::id())
            ->get();

        $countRekomendasi = Rekomendasi::where('user_id', auth()->user()->id)->count();

        return view('pages.standarpertanyaanaudit.index', compact('data', 'tahun', 'user', 'plans', 'countRekomendasi'));
    }

    public function create_nilai($id)
    {
        return view('pages.standarpertanyaanaudit.create_nilai', compact('id'));
    }

    public function store_nilai(Request $request, $id)
    {

        // Simpan informasi file ke dalam model "Value"
        $value = new Value();
        $value->score = $request->score;
        $value->user_id = auth()->user()->id;
        $value->standard_id = $id;
        // Tambahkan kolom lain yang sesuai
        $value->save();

        return redirect()->route('standarpertanyaan.audit')->with('message', 'Nilai berhasil ditambahkan.');
    }

    public function create_rekomendasi($id)
    {
        return view('pages.standarpertanyaanaudit.create_rekomendasi', compact('id'));
    }

    public function store_rekomendasi(Request $request, $id)
    {

        // Simpan informasi file ke dalam model "Value"
        $value = new Rekomendasi();
        $value->value = $request->value;
        $value->user_id = auth()->user()->id;
        $value->standard_id = $id;
        // Tambahkan kolom lain yang sesuai
        $value->save();

        return redirect()->route('standarpertanyaan.audit')->with('message', 'Rekomendasi berhasil ditambahkan.');
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
        return view('pages.laporan-audit.laporan_ami', compact('data', 'tahun'));
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

        return view('pages.laporan-audit.laporan_ketercapaian', compact('data', 'tahun'));
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

        return view('pages.laporan-audit.laporan_ringan', compact('data', 'tahun'));
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

        return view('pages.laporan-audit.laporan_berat', compact('data', 'tahun'));
    }

    public function print(Request $request, $type) {
        $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
            ->get();

        return view('pages.laporan-audit.print', compact('data', 'type'));
    }
}
