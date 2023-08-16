<?php

namespace App\Http\Controllers;

use App\Models\AuditPlan;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $prodi = User::where('role', 'prodi')->get()->toArray();
        array_walk($prodi, function (&$p, $id) {
            $plans = AuditPlan::with('audits')->where("study_program_id", '=', $p['id'])->get()->toArray();
            foreach ($plans as $v) {
                foreach ($v['audits'] as $s) {
                    if ($s['value'] == 0) {
                        $p['skor0'][] = $s;
                    }
                    if ($s['value'] == 1) {
                        $p['skor1'][] = $s;
                    }
                    if ($s['value'] == 2) {
                        $p['skor2'][] = $s;
                    }
                    if ($s['value'] == 3) {
                        $p['skor3'][] = $s;
                    }
                    if ($s['value'] == 4) {
                        $p['skor4'][] = $s;
                    }
                }
            }
            $p['skor0'] = isset($p['skor0']) ? $p['skor0'] : [];
            $p['skor1'] = isset($p['skor1']) ? $p['skor1'] : [];
            $p['skor2'] = isset($p['skor2']) ? $p['skor2'] : [];
            $p['skor3'] = isset($p['skor3']) ? $p['skor3'] : [];
            $p['skor4'] = isset($p['skor4']) ? $p['skor4'] : [];
        });
        return view('pages.laporan.index', compact('prodi'));
    }

    public function ketercapaian()
    {
        $prodi = User::where('role', 'prodi')->get()->toArray();
        array_walk($prodi, function (&$p, $id) {
            $plans = AuditPlan::with('audits')->where("study_program_id", '=', $p['id'])->get()->toArray();
            foreach ($plans as $v) {
                foreach ($v['audits'] as $s) {
                    if ($s['value'] == 4) {
                        $p['skor'][] = $s;
                    }
                }
            }
            $p['skor'] = isset($p['skor']) ? $p['skor'] : [];
        });
        return view('pages.laporan.ketercapaian', compact('prodi'));
    }

    public function temuan_ringan()
    {
        $prodi = User::where('role', 'prodi')->get()->toArray();
        array_walk($prodi, function (&$p, $id) {
            $plans = AuditPlan::with('audits')->where("study_program_id", '=', $p['id'])->get()->toArray();
            foreach ($plans as $v) {
                foreach ($v['audits'] as $s) {
                    if ($s['value'] == 2 || $s['value'] == 3) {
                        $p['skor'][] = $s;
                    }
                }
            }
            $p['skor'] = isset($p['skor']) ? $p['skor'] : [];
        });
        return view('pages.laporan.temuan_ringan', compact('prodi'));
    }

    public function temuan_berat()
    {
        $prodi = User::where('role', 'prodi')->get()->toArray();
        array_walk($prodi, function (&$p, $id) {
            $plans = AuditPlan::with('audits')->where("study_program_id", '=', $p['id'])->get()->toArray();
            foreach ($plans as $v) {
                foreach ($v['audits'] as $s) {
                    if ($s['value'] == 0 || $s['value'] == 1) {
                        $p['skor'][] = $s;
                    }
                }
            }
            $p['skor'] = isset($p['skor']) ? $p['skor'] : [];
        });
        return view('pages.laporan.temuan_berat', compact('prodi'));
    }

    public function print($id) {
        $detail = AuditPlan::with([
            'audits', 'audits', 'audits.question', 'audits.value', 'audits.question.standard', 'audits.value.standard',
            'faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2',
        ])->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.laporan.print', [
            'detail' => $detail,
        ]);

        return $pdf->stream();
    }
}
