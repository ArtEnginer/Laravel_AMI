<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest\Store;
use App\Http\Requests\AdminRequest\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUserId = Auth::id();

        if ($request->ajax()) {
            $query = User::where('role', 'admin')
                ->whereNot('id', $currentUserId)
                ->get();

            return DataTables::of($query)->make();
        }

        return view('pages.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $data = [
            'nidn' => $request->nidn,
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatar', 'public');
        }

        User::create($data);

        return redirect('admin')->with('toast', 'showToast("Data berhasil disimpan")');
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

        return view('pages.admin.edit', [
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'nidn' => $request->nidn,
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
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

        return redirect('admin')->with('toast', 'showToast("Data berhasil diupdate")');
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
