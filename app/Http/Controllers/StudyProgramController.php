<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudyProgramRequest\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::where('role', 'prodi')->get();
            return DataTables::of($query)->make();
        }

        return view('pages.prodi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $data = [
            'name' => $request->name,
            'kaprodi' => $request->kaprodi,
            'nidn' => $request->nidn,
            'email' => $request->email,
            'role' => 'prodi',
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatar', 'public');
        }

        User::create($data);

        return redirect('prodi')->with('toast', 'showToast("Data berhasil disimpan")');
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

        return view('pages.prodi.edit', [
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
            'name' => $request->name,
            'kaprodi' => $request->kaprodi,
            'nidn' => $request->nidn,
            'email' => $request->email,
            'role' => 'prodi',
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

        return redirect('prodi')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
