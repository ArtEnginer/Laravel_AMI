<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahun;
use Yajra\DataTables\Facades\DataTables;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Tahun::get();
            return DataTables::of($query)->make();
        }

        return view('pages.tahun.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tahun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'value' => 'required',
        ]);

        Tahun::create($data);

        return redirect('tahun')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Tahun::findOrFail($id);

        return view('pages.tahun.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Tahun::findOrFail($id);

        $data = $request->validate([
            'value' => 'required',
        ]);

        $item->update($data);

        return redirect('tahun')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Tahun::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
