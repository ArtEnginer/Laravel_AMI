<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuditPlanRequest;
use App\Models\AuditPlan;
use App\Models\Faculty;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AuditPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = AuditPlan::with([
                'faculty', 'study_program', 'lead_auditor', 'auditor_1', 'auditor_2'
            ])->get();
            return DataTables::of($query)->make();
        }

        return view('pages.ami.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        $study_programs = User::where('role', 'prodi')->get();
        $auditor = User::where('role', 'auditor')->get();
        $tahun = Tahun::get();

        return view('pages.ami.create', [
            'faculties' => $faculties,
            'study_programs' => $study_programs,
            'auditor' => $auditor,
            'tahun' => $tahun,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuditPlanRequest $request)
    {

        $data = [
            'faculty_id' => $request->faculty_id,
            'study_program_id' => $request->study_program_id,
            'lead_auditor_id' => $request->lead_auditor_id,
            'auditor_1_id' => $request->auditor_1_id,
            'auditor_2_id' => $request->auditor_1_id,
            'tahun' => $request->tahun
        ];

        AuditPlan::create($data);

        return redirect('ami')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = AuditPlan::findOrFail($id);
        $faculties = Faculty::all();
        $study_programs = User::where('role', 'prodi')->get();
        $auditor = User::where('role', 'auditor')->get();
        $tahun = Tahun::get();

        return view('pages.ami.edit', [
            'item' => $item,
            'faculties' => $faculties,
            'study_programs' => $study_programs,
            'auditor' => $auditor,
            'tahun' => $tahun,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'faculty_id' => $request->faculty_id,
            'study_program_id' => $request->study_program_id,
            'lead_auditor_id' => $request->lead_auditor_id,
            'auditor_1_id' => $request->auditor_1_id,
            'auditor_2_id' => $request->auditor_1_id,
            'tahun' => $request->tahun
        ];

        $item = AuditPlan::findOrFail($id);
        $item->update($data);

        return redirect('ami')->with('toast', 'showToast("Data berhasil diubah")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = AuditPlan::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
