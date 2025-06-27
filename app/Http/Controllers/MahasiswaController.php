<?php

namespace App\Http\Controllers;

use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mahasiswa = Mahasiswa::all();
        return MahasiswaResource::collection($mahasiswa);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|in:Laki-laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',     
        ]);
        $mahasiswa = Mahasiswa::create($request->all());
        return (new MahasiswaResource($mahasiswa))
            ->additional([
                'status' => true,
                'message' => 'Data Mahasiswa created successfully',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->validate([
            'nim' => 'required|string|max:12|unique:mahasiswa,nim,' . $id. ',nim',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|in:Laki-laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255'
        ]);
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return (new MahasiswaResource($mahasiswa))
            ->additional([
                'status' => true,
                'message' => 'Data Mahasiswa updated successfully',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return (new MahasiswaResource($mahasiswa))
            ->additional([
                'status' => true,
                'message' => 'Data Mahasiswa deleted successfully',
            ]);
    }
}
