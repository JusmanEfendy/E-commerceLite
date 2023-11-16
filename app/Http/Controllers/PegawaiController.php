<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pegawai';
        $pegawaies = Pegawai::paginate(5);

        return view('admin.pegawai.index', compact('pegawaies', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Pegawai';

        return view('admin.pegawai.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datas = $request->validate([
            'KodePegawai' => 'required|max:8',
            'NamaPegawai' => 'required|string|max:255',
            'Gambar' => 'required|image|mimes:jpeg,jpg,png|file|max:2048',
            'Jabatan' => 'required|string',
            'NoTeleponPegawai' => 'required',
        ]);

        $gambar = $datas['Gambar'] = $request->file('Gambar')->store('gambar-pegawai');

        Pegawai::create([
            'KodePegawai' => $datas['KodePegawai'],
            'NamaPegawai' => $datas['NamaPegawai'],
            'Gambar' => $gambar,
            'Jabatan' => $datas['Jabatan'],
            'NoTeleponPegawai' => $datas['NoTeleponPegawai'],
        ]);

        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Pegawai';
        $pegawai = Pegawai::find($id);
    
        return view('admin.pegawai.edit', compact('pegawai', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $pegawai = Pegawai::find($id);

        $datas = $request->validate([
            'KodePegawai' => 'required|max:8',
            'NamaPegawai' => 'required|string|max:255',
            'Gambar' => 'required|image|mimes:jpeg,jpg,png|file|max:2048',
            'Jabatan' => 'required|string',
            'NoTeleponPegawai' => 'required'
        ]);

        if($request->gambarOld){
            Storage::delete($request->gambarOld);
        }

        $gambar = $datas['Gambar'] = $request->file('Gambar')->store('gambar-pegawai');

        $pegawai->update([
            'KodePegawai' => $request['KodePegawai'],
            'NamaPegawai' => $request['NamaPegawai'],
            'Gambar' => $gambar,
            'Jabatan' => $request['Jabatan'],
            'NoTeleponPegawai' => $request['NoTeleponPegawai'],
        ]);

        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Pegawai $pegawai, string $id)
    {
        $del = Pegawai::find($id);

        Storage::delete($del->Gambar);

        $pegawai->destroy($id);
        return redirect()->route('pegawai')->with('success', 'Barang berhasil dihapus');
    }
}
