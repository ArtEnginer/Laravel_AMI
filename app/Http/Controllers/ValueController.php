<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use App\Models\Value;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Value::with('standard')->get();
            return DataTables::of($query)->make();
        }

        return view('pages.nilai.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $standards = Standard::all();
        return view('pages.nilai.create', [
            'standards' => $standards
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'standard_id' => 'required|exists:standards,id',
            'answer' => 'required',
            'score' => 'required',
        ]);

        Value::create($data);

        return redirect('nilai')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Value::findOrFail($id);
        $standards = Standard::all();

        return view('pages.nilai.edit', [
            'item' => $item,
            'standards' => $standards,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Value::findOrFail($id);

        $data = $request->validate([
            'standard_id' => 'required|exists:standards,id',
            'answer' => 'required',
            'score' => 'required',
        ]);

        $item->update($data);

        return redirect('nilai')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Value::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
