<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\AuditPlan;
use App\Models\Standard;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private function _score($id, $score)
    {
        return Audit::join('audit_plans', 'audit_plans.id', '=', 'audits.audit_plan_id')
            ->join('values', 'values.id', '=', 'audits.value_id')
            ->where('study_program_id', $id)
            ->where('score', $score)
            ->count();
    }

    public function index(Request $request)
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

        return view('pages.laporan.index', compact('data', 'tahun'));
    }

    public function temuan_ringan()
    {
        $prodi = User::where('role', 'prodi')->get();

        $result = [];
        foreach ($prodi as $p) {
            $score_4 = $this->_score($p->id, '4');
            $score_3 = $this->_score($p->id, '3');
            $score_2 = $this->_score($p->id, '2');
            $score_1 = $this->_score($p->id, '1');
            $score_0 = $this->_score($p->id, '0');
            $total_score = (($score_0 * 0) + ($score_1 * 20) + ($score_2 * 30) + ($score_3 * 40) + ($score_4 * 50));

            if ($total_score >= 41 && $total_score <= 60) {
                $result[] = [
                    'study_program_id' => $p->id,
                    'name' => $p->name,
                    'score_4' => $score_4,
                    'score_3' => $score_3,
                    'score_2' => $score_2,
                    'score_1' => $score_1,
                    'score_0' => $score_0,
                    'total_score' => $total_score,
                ];
            }
        }

        return view('pages.laporan.temuan_ringan', [
            'result' => $result,
        ]);
    }

    public function temuan_berat()
    {
        $prodi = User::where('role', 'prodi')->get();

        $result = [];
        foreach ($prodi as $p) {
            $score_4 = $this->_score($p->id, '4');
            $score_3 = $this->_score($p->id, '3');
            $score_2 = $this->_score($p->id, '2');
            $score_1 = $this->_score($p->id, '1');
            $score_0 = $this->_score($p->id, '0');
            $total_score = (($score_0 * 0) + ($score_1 * 20) + ($score_2 * 30) + ($score_3 * 40) + ($score_4 * 50));

            if ($total_score <= 40) {
                $result[] = [
                    'study_program_id' => $p->id,
                    'name' => $p->name,
                    'score_4' => $score_4,
                    'score_3' => $score_3,
                    'score_2' => $score_2,
                    'score_1' => $score_1,
                    'score_0' => $score_0,
                    'total_score' => $total_score,
                ];
            }
        }

        return view('pages.laporan.temuan_berat', [
            'result' => $result,
        ]);
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
