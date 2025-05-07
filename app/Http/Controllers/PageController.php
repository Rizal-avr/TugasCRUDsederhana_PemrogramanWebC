<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;


class PageController extends Controller
{


    public function pengelolaan(Request $request)
    {


        $penjualan = Penjualan::orderBy('tanggal', 'desc')->get();
        return view('pengelolaan', ['salesData' => $penjualan]);
    }

    public function storePenjualan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_sayur' => 'required|string',
            'nama_pembeli' => 'required|string',
            'kuantitas' => 'required|numeric|min:0.1',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $penjualan = new Penjualan();
        $penjualan->tanggal = $request->tanggal;
        $penjualan->nama_sayur = $request->nama_sayur;
        $penjualan->nama_pembeli = $request->nama_pembeli;
        $penjualan->kuantitas = $request->kuantitas;
        $penjualan->harga_jual = $request->harga_jual;
        $penjualan->penghasilan = $request->kuantitas * $request->harga_jual;
        $penjualan->save();

        return redirect()->route('pengelolaan')->with('success', 'Data penjualan berhasil ditambahkan!');
    }

    public function updatePenjualan(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_sayur' => 'required|string',
            'nama_pembeli' => 'required|string',
            'kuantitas' => 'required|numeric|min:0.1',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->tanggal = $request->tanggal;
        $penjualan->nama_sayur = $request->nama_sayur;
        $penjualan->nama_pembeli = $request->nama_pembeli;
        $penjualan->kuantitas = $request->kuantitas;
        $penjualan->harga_jual = $request->harga_jual;
        $penjualan->penghasilan = $request->kuantitas * $request->harga_jual;
        $penjualan->save();

        return redirect()->route('pengelolaan')->with('success', 'Data penjualan berhasil diperbarui!');
    }

    public function deletePenjualan($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data penjualan berhasil dihapus!',
            'deleted_id' => $id
        ]);
    }

    public function getPenjualan($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return response()->json($penjualan);
    }

}