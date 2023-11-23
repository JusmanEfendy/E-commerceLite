<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $title = 'List Barang';

        if($request->has('search')) {
            $barangs = Barang::where('NamaBarang', 'LIKE', '%' .$request->search. '%')->paginate(5);
        }else {
            $barangs = Barang::orderBy('id', 'desc')->paginate(5);
        }

        return view('admin.barang.index', compact('title', 'barangs'));
    }

    public function create()
    {
        $title = 'Tambah Barang';
        return view('admin.barang.create', compact('title'));
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'KodeBarang' => 'required|max:8',
            'NamaBarang' => 'required|string|max:255',
            'HargaBarang' => 'required',
            'Gambar' => 'required|image|mimes:jpeg,jpg,png|file|max:2048',
            'StokBarang' => 'required|integer|min:0',
            'DeskripsiBarang' => 'nullable',
            'Satuan' => 'nullable',
        ]);

        // menambahkan gambar ke file public di folder gambar-barang
        $gambar = $datas['Gambar'] = $request->file('Gambar')->store('gambar-barang');

        // koversi harga ke string
        $satuanHarga = $this->formatter($datas['HargaBarang']);

            Barang::create([
            'KodeBarang' => $datas['KodeBarang'],
            'NamaBarang' => $datas['NamaBarang'],
            'HargaBarang' => $datas['HargaBarang'],
            'Gambar' => $gambar,
            'StokBarang' => $datas['StokBarang'],
            'DeskripsiBarang' => $datas['DeskripsiBarang'],
            'Satuan' => $satuanHarga,
        ]);
        
        return redirect()->route('barang')->with('success', 'Barang berhasil ditambah');
    }

    public function edit($id)
    {
        $title = 'Edit Barang';
        $barang = Barang::find($id);

        return view('admin.barang.edit', compact('barang', 'title'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        $datas = $request->validate([
            'KodeBarang' => 'required|max:8',
            'NamaBarang' => 'required|string|max:255',
            'HargaBarang' => 'required',
            'Gambar' => 'required|image|mimes:jpeg,jpg,png|file|max:2048',
            'StokBarang' => 'required|integer|min:1',
            'DeskripsiBarang' => 'nullable',
            'Satuan' => 'nullable',
        ]);

        // hapus gambar lama ganti gambar yang baru
        if($request->gambarOld){
            Storage::delete($request->gambarOld);
        }

        $gambar = $datas['Gambar'] = $request->file('Gambar')->store('gambar-barang');

        // format harga ke satuan
        $satuanHarga = $this->formatter($datas['HargaBarang']);

        $barang->update([
            'KodeBarang' => $datas['KodeBarang'],
            'NamaBarang' => $datas['NamaBarang'],
            'HargaBarang' => $datas['HargaBarang'],
            'Gambar' => $gambar,
            'StokBarang' => $datas['StokBarang'],
            'DeskripsiBarang' => $datas['DeskripsiBarang'],
            'Satuan' => $satuanHarga,
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil diubah');
    }

    public function destroy(Barang $barang, $id)
    {
        $del = Barang::find($id);

        Storage::delete($del->Gambar);

        $barang->destroy($id);
        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
    }

    // function untuk mengformat angka menjadi kata
    public function formatter($angkaInputan)
    {
        $formatAngka = new NumberFormatter('id', NumberFormatter::SPELLOUT);
        $output = $formatAngka->format($angkaInputan);

        return $output;
    }
}
