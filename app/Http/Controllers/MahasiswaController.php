<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi= "TI";
        $mahasiswas = Mahasiswa::select('id','nama', 'nim', 'email')
                                // ->where(['nim' => '2303000066', 'id' => 4])
                                ->orderBy('nama')
                                ->paginate(10);


        // "Select nama, id from mahasiswas where prodi = 'TI' order by nama asc";
        // return response()->json($mahasiswas);

        return view('mahasiswa.index', compact('mahasiswas', 'prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:6'],
            'nim'  => ['required', 'string', 'max:10', 'min:10', 'unique:mahasiswas,nim'],
            'email' => ['required', 'email', 'max:100', 'unique:mahasiswas,email'],
        ], [
            'nama.max' =>  "Nama Maksimal 6 karakter"
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // return response()->json($request);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nim'  => ['required', 'string', 'max:20', 'unique:mahasiswas,nim,' . $mahasiswa->id],
            'email' => ['required', 'email', 'max:100', 'unique:mahasiswas,email,' . $mahasiswa->id],
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
