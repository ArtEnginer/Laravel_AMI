<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Faculty::all();
            return DataTables::of($query)->make();
        }

        return view('pages.fakultas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'dekan' => 'required',
            'nidn' => 'required|numeric|max_digits:12',
            'telp' => 'required|numeric|max_digits:13',
        ]);

        Faculty::create($data);

        return redirect('fakultas')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Faculty::findOrFail($id);

        return view('pages.fakultas.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Faculty::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'dekan' => 'required',
            'nidn' => 'required|numeric|max_digits:12',
            'telp' => 'required|numeric|max_digits:13',
        ]);

        $item->update($data);

        return redirect('fakultas')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Faculty::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
