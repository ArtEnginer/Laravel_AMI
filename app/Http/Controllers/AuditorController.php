<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuditorRequest\Store;
use App\Models\Faculty;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with(['faculty', 'study_program'])->where('role', 'auditor')->get();
            return DataTables::of($query)->make();
        }

        return view('pages.auditor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studyPrograms = User::where('role', 'prodi')->get();
        $faculties = Faculty::all();

        return view('pages.auditor.create', [
            'studyPrograms' => $studyPrograms,
            'faculties' => $faculties
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $data = [
            'study_program_id' => $request->study_program_id,
            'faculty_id' => $request->faculty_id,
            'nidn' => $request->nidn,
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'auditor',
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatar', 'public');
        }

        User::create($data);

        return redirect('auditor')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = User::findOrFail($id);
        $studyPrograms = User::where('role', 'prodi')->get();
        $faculties = Faculty::all();

        return view('pages.auditor.edit', [
            'studyPrograms' => $studyPrograms,
            'faculties' => $faculties,
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'study_program_id' => $request->study_program_id,
            'faculty_id' => $request->faculty_id,
            'nidn' => $request->nidn,
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'auditor',
            'username' => $request->username,
        ];

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $path = "avatar/";
            $oldfile = $path . basename($user->avatar);
            Storage::disk('public')->delete($oldfile);
            $data['avatar'] = Storage::disk('public')->put($path, $request->file('avatar'));
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('auditor')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}