<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\AuditPlan;
use App\Models\Faculty;
use App\Models\Question;
use App\Models\User;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $role = Auth::user()->role;

        switch ($role) {
            case "admin":
                $data = [
                    'admin' => User::where('role', 'admin')->count(),
                    'auditor' => User::where('role', 'auditor')->count(),
                    'auditee' => User::where('role', 'prodi')->count(),
                    'fakultas' => Faculty::count(),
                ];

                return view('pages.dashboard.admin', $data);
                break;
            case "auditor":
                // $data['ami'] = AuditPlan::with(['faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2'])
                //     ->where('lead_auditor_id', $userId)
                //     ->orWhere('auditor_1_id', $userId)
                //     ->orWhere('auditor_2_id')
                //     ->get();

                // return view('pages.dashboard.auditor', $data);
                return redirect()->route('standarpertanyaan.audit');
                break;
            default:
                $data['ami'] = AuditPlan::with(['faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2']);
                //     ->where('study_program_id', $userId)
                //     ->get();

                // return view('pages.dashboard.prodi', $data);

                return redirect()->route('standarpertanyaan.index');
                break;
        }
    }

    public function audit($id)
    {
        $auditPlan = AuditPlan::with([
            'audits', 'audits.question', 'audits.value', 'audits.question.standard', 'audits.value.standard'
        ])->findOrFail($id);
        $question = Question::all();
        $value = Value::all();

        return view('pages.dashboard.audit.index', [
            'auditPlan' => $auditPlan,
            'question' => $question,
            'value' => $value,
        ]);
    }

    public function delete_audit($id)
    {
        $item = Audit::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil didelete")');
    }

    public function input_audit(Request $request)
    {
        $data = $request->validate([
            'audit_plan_id' => 'required|exists:audit_plans,id',
            'question_id' => 'required|exists:questions,id',
            'value_id' => 'required|exists:values,id',
        ]);

        Audit::create($data);

        return redirect()->back()->with('toast', 'showToast("Data berhasil disimpan")');
    }

    public function ubah_status_audit($id)
    {
        $item = AuditPlan::findOrFail($id);
        $data['status'] = $item->status == 'proses' ? 'selesai' : 'proses';

        $item->update($data);

        return redirect()->back()->with('toast', 'showToast("Data berhasil diupdate")');
    }

    public function kesimpulan($id)
    {
        $item = AuditPlan::findOrFail($id);

        return view('pages.dashboard.audit.kesimpulan', [
            'item' => $item
        ]);
    }

    public function update_kesimpulan(Request $request, $id)
    {
        $item = AuditPlan::findOrFail($id);

        $data = $request->validate([
            'kelengkapan' => 'nullable',
            'kesimpulan' => 'nullable',
        ]);

        if ($data['kelengkapan'] == 'lengkap') {
            $data['kesimpulan'] = 'Lengkap';
        }

        $item->update($data);

        return redirect('dashboard')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    public function tanggal_rtm($id)
    {
        $item = AuditPlan::findOrFail($id);

        return view('pages.dashboard.audit.tanggal_rtm', [
            'item' => $item
        ]);
    }

    public function update_tanggal_rtm(Request $request, $id)
    {
        $item = AuditPlan::findOrFail($id);

        $data = $request->validate([
            'tanggal_rtm' => 'required|date',
        ]);

        $item->update($data);

        return redirect('dashboard')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    public function foto_kegiatan($id)
    {
        $item = AuditPlan::findOrFail($id);

        return view('pages.dashboard.audit.foto_kegiatan', [
            'item' => $item
        ]);
    }

    public function upload_foto_kegiatan(Request $request, $id)
    {
        $item = AuditPlan::findOrFail($id);

        $path = 'foto_kegiatan/';

        $data = $request->validate([
            'foto_kegiatan' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto_kegiatan') && $request->file('foto_kegiatan')->isValid()) {
            $oldfile = $path . basename($item->foto_kegiatan);
            Storage::disk('public')->delete($oldfile);
            $data['foto_kegiatan'] = Storage::disk('public')->put($path, $request->file('foto_kegiatan'));
            $item->update($data);

            return redirect('dashboard')->with('toast', 'showToast("Data berhasil diupdate")');
        }
    }

    public function profile()
    {
        $prodi = User::where('role', 'prodi')->get();
        $fakultas = Faculty::all();

        return view('pages.profile', [
            'prodi' => $prodi,
            'fakultas' => $fakultas,
        ]);
    }

    public function changeAvatar(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $path = "avatar/";
            $oldfile = $path . basename($user->avatar);
            Storage::disk('public')->delete($oldfile);
            $data['avatar'] = Storage::disk('public')->put($path, $request->file('avatar'));

            $user->update($data);
        }

        return redirect()->back();
    }

    public function removeAvatar()
    {
        $user = User::findOrFail(auth()->user()->id);

        $path = "avatar/";
        $oldfile = $path . basename($user->avatar);
        Storage::disk('public')->delete($oldfile);
        $data['avatar'] = NULL;

        $user->update($data);

        return redirect()->back();
    }
}
