<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\AuditPlan;
use App\Models\Bukti;
use App\Models\Faculty;
use App\Models\Rekomendasi;
use App\Models\Standard;
use App\Models\Tahun;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->query('action') == "plans") {
                $q = AuditPlan::with('faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2');
                $q = $request->query('faculty') == "none" ? $q : $q->where('faculty_id', '=', $request->query('faculty'));
                $q = $request->query('year') == "none" ? $q : $q->where('tahun', '=', $request->query('year'));
                return json_encode($q->get());
            }
            if ($request->query('action') == "audit") {
                $standards = Standard::with('pertanyaan')
                    ->get()->toArray();
                array_walk($standards, function (&$value, $key, $request) {
                    $value['bukti'] = Bukti::where('audit_plan_id', '=', 1)->where('standard_id', '=', $value['id'])->first();
                    $value['nilai'] = Audit::where('auditor_id', '=', Auth::id())
                        ->where('audit_plan_id', '=', $request->query('plan_id'))
                        ->where('standard_id', '=', $value['id'])->first();
                    $value['rekomendasi'] = Rekomendasi::where('user_id', '=', Auth::id())
                        ->where('audit_plan_id', '=', $request->query('plan_id'))
                        ->where('standard_id', '=', $value['id'])->first();
                }, $request);
                return json_encode($standards);
            }
            return json_encode([]);
        }
        $facultys = Faculty::get();
        $user = Auth::user();
        $tahun = Tahun::get();
        $data = Standard::with('pertanyaan', 'bukti', 'score', 'rekomendasi')
            ->get();
        $plans = AuditPlan::with('faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2')
            ->where('lead_auditor_id', '=', Auth::id())
            ->orWhere('auditor_2_id', '=', Auth::id())
            ->get();

        $countRekomendasi = Rekomendasi::where('user_id', auth()->user()->id)->count();

        return view('pages.standarpertanyaanaudit.index', compact('data', 'facultys', 'tahun', 'user', 'plans', 'countRekomendasi'));
    }

    public function create_nilai($id, $sid)
    {
        $nilai = Value::where('standard_id', '=', $sid)->get();
        return view('pages.standarpertanyaanaudit.create_nilai', compact('id', 'sid', 'nilai'));
    }

    public function store_nilai(Request $request, $id, $sid)
    {

        // Simpan informasi file ke dalam model "Value"
        $value = new Audit();
        $value->audit_plan_id = $id;
        $value->standard_id = $sid;
        $value->value = $request->score;
        $value->auditor_id = auth()->user()->id;
        // Tambahkan kolom lain yang sesuai
        $value->save();

        return redirect()->route('standarpertanyaan.audit')->with('message', 'Nilai berhasil ditambahkan.');
    }

    public function create_rekomendasi($id, $sid)
    {
        return view('pages.standarpertanyaanaudit.create_rekomendasi', compact('id'));
    }

    public function store_rekomendasi(Request $request, $id, $sid)
    {

        // Simpan informasi file ke dalam model "Value"
        $value = new Rekomendasi();
        $value->audit_plan_id = $id;
        $value->standard_id = $sid;
        $value->user_id = auth()->user()->id;
        $value->value = $request->value;
        // Tambahkan kolom lain yang sesuai
        $value->save();

        return redirect()->route('standarpertanyaan.audit')->with('message', 'Rekomendasi berhasil ditambahkan.');
    }

    public function laporan_ami(Request $request)
    {
        $auditorId = Auth::id();
        $auditorIdentity = Audit::with('auditor', 'audit_plan', 'audit_plan.faculty', 'audit_plan.study_program', 'audit_plan.lead_auditor', 'audit_plan.auditor_1', 'audit_plan.auditor_2')->where('auditor_id', $auditorId)->first();

        $user = Auth::user();
        $tahun = Tahun::get();

        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where([['tahun', '=', $selectedYear], ['lead_auditor_id', '=', Auth::id()]])->orWhere('auditor_2_id', '=', Auth::id())->get();
        } else {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where('lead_auditor_id', '=', Auth::id())->orWhere('auditor_2_id', '=', Auth::id())->get();
        }

        return view('pages.laporan-audit.laporan_ami', compact('data', 'tahun', 'auditorIdentity', 'user'));
    }

    public function laporan_ketercapaian(Request $request)
    {
        $auditorId = Auth::id();
        $auditorIdentity = Audit::with('auditor', 'audit_plan', 'audit_plan.faculty', 'audit_plan.study_program', 'audit_plan.lead_auditor', 'audit_plan.auditor_1', 'audit_plan.auditor_2')->where('auditor_id', $auditorId)->first();
        $user = Auth::user();
        $tahun = Tahun::get();

        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where([['tahun', '=', $selectedYear], ['lead_auditor_id', '=', Auth::id()]])->orWhere('auditor_2_id', '=', Auth::id())->get();
        } else {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where('lead_auditor_id', '=', Auth::id())->orWhere('auditor_2_id', '=', Auth::id())->get();
        }

        return view('pages.laporan-audit.laporan_ketercapaian', compact('data', 'tahun', 'user', 'auditorIdentity'));
    }

    public function laporan_temuan_ringan(Request $request)
    {
        $auditorId = Auth::id();
        $auditorIdentity = Audit::with('auditor', 'audit_plan', 'audit_plan.faculty', 'audit_plan.study_program', 'audit_plan.lead_auditor', 'audit_plan.auditor_1', 'audit_plan.auditor_2')->where('auditor_id', $auditorId)->first();
        $user = Auth::user();
        $tahun = Tahun::get();

        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where([['tahun', '=', $selectedYear], ['lead_auditor_id', '=', Auth::id()]])->orWhere('auditor_2_id', '=', Auth::id())->get();
        } else {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where('lead_auditor_id', '=', Auth::id())->orWhere('auditor_2_id', '=', Auth::id())->get();
        }

        return view('pages.laporan-audit.laporan_ringan', compact('data', 'tahun', 'user', 'auditorIdentity'));
    }

    public function laporan_temuan_berat(Request $request)
    {
        $auditorId = Auth::id();
        $auditorIdentity = Audit::with('auditor', 'audit_plan', 'audit_plan.faculty', 'audit_plan.study_program', 'audit_plan.lead_auditor', 'audit_plan.auditor_1', 'audit_plan.auditor_2')->where('auditor_id', $auditorId)->first();
        $user = Auth::user();
        $tahun = Tahun::get();

        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where([['tahun', '=', $selectedYear], ['lead_auditor_id', '=', Auth::id()]])->orWhere('auditor_2_id', '=', Auth::id())->get();
        } else {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where('lead_auditor_id', '=', Auth::id())->orWhere('auditor_2_id', '=', Auth::id())->get();
        }

        return view('pages.laporan-audit.laporan_berat', compact('data', 'tahun', 'user', 'auditorIdentity'));
    }

    public function print(Request $request, $type)
    {
        $user = Auth::user();
        $auditorId = Auth::id();
        $auditorIdentity = Audit::with('auditor', 'audit_plan', 'audit_plan.faculty', 'audit_plan.study_program', 'audit_plan.lead_auditor', 'audit_plan.auditor_1', 'audit_plan.auditor_2')->where('auditor_id', $auditorId)->first();

        $selectedYear = $request->year;
        if ($selectedYear != null) {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where([['tahun', '=', $selectedYear], ['lead_auditor_id', '=', Auth::id()]])->orWhere('auditor_2_id', '=', Auth::id())->get();
        } else {
            $data = AuditPlan::with('audits', 'audits.standard', 'audits.standard.pertanyaan', 'rekomendasi', 'bukti')->where('lead_auditor_id', '=', Auth::id())->orWhere('auditor_2_id', '=', Auth::id())->get();
        }

        return view('pages.laporan-audit.print', compact('data', 'type', 'auditorIdentity', 'user'));
    }
}
