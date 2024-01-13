<?php

namespace App\Http\Controllers;

use App\Models\KelompokProduk;
use App\Models\Produk;
use App\Models\StatusProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('id', 'DESC')->paginate(5);

        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        $status = StatusProduk::get();
        $kelompok = KelompokProduk::get();
        return view('admin.produk.create', compact('status', 'kelompok'));
    }

    public function store(Request $request)
    {       
        $request->validate([
            'kode_produk' => 'required|max:12',
            'nama_produk' => 'required|max:30',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'kode_status' => 'required',
            'kode_kelompok' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        Produk::create([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kode_status' => $request->kode_status,
            'kode_kelompok' => $request->kode_kelompok,
            'stok' => $request->stok,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambah');
    }

    public function edit($id)
    {
        $produk = Produk::where('kode_produk', $id)->first();
        $status = StatusProduk::get();
        $kelompok = KelompokProduk::get();

        return view('admin.produk.edit', compact('produk', 'status', 'kelompok'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $produk = Produk::where('kode_produk', $id)->first();
        
        $request->validate([
            'kode_produk' => 'required|max:12',
            'nama_produk' => 'required|max:30',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'kode_status' => 'required',
            'kode_kelompok' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $produk->update([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kode_status' => $request->kode_status,
            'kode_kelompok' => $request->kode_kelompok,
            'stok' => $request->stok,
        ]);
        
        return redirect()->route('produk')->with('success', 'Produk berhasil diubah');
    }

    public function search(Request $request)
    {
        if($request->has('search')) {
            $produk = Produk::where('kode_produk', 'LIKE', '%' .$request->search. '%')->get();
        }

        return view('admin.produk.search', compact('produk'));
    }
}
