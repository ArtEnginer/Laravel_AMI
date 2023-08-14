<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Standard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Question::with(['standard'])->get();
            return DataTables::of($query)->make();
        }

        return view('pages.pertanyaan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $standards = Standard::all();
        return view('pages.pertanyaan.create', [
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
            'questionText' => 'required',
        ]);

        Question::create($data);

        return redirect('pertanyaan')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = Question::findOrFail($id);
        $standards = Standard::all();

        return view('pages.pertanyaan.edit', [
            'item' => $item,
            'standards' => $standards
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Question::findOrFail($id);

        $data = $request->validate([
            'standard_id' => 'required|exists:standards,id',
            'questionText' => 'required',
        ]);

        $item->update($data);

        return redirect('pertanyaan')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Question::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
