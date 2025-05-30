<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDijualRequest;
use App\Http\Requests\UpdateDijualRequest;
use App\Models\Dijual;

class DijualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjualan.index', [
            'dijuals' => Dijual::with(['barang'])->latest()->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDijualRequest $request)
    {
        $validatedData = $request->validated();
        Dijual::create($validatedData);

        return redirect()->route('penjualan.index')->with('success', 'Barang berhasil ditambahkan ke daftar dijual.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dijual $dijual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dijual $dijual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDijualRequest $request, Dijual $dijual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dijual $dijual)
    {
        //
    }
}
