<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rak;

class RakController extends Controller
{
    // Menampilkan form tambah rak
    public function showCreateForm()
    {
        return view('admin.admin_create_rak');
    }

    // Menampilkan data semua rak
    public function readRak()
    {
        $rak = Rak::orderBy('rak_lokasi')
            ->paginate(10);
        return view('admin.rak', compact('rak'));
    }

    // Menyimpan data rak baru
    public function store(Request $request)
    {
        $id = mt_rand(1000000000000000, 9999999999999999);

        $data = [
            'rak_id' => $id,
            'rak_nama' => $request->input('rak_nama'),
            'rak_lokasi' => $request->input('rak_lokasi'),
            'rak_kapasitas' => $request->input('rak_kapasitas'),
        ];

        Rak::create($data);
        return redirect()->route('rak')->with('success', 'Data rak berhasil ditambahkan!');
    }

    // Menampilkan form edit rak
    public function edit($id)
    {
        $rak = Rak::find($id);
        return view('admin.admin_update_rak', compact('rak'));
    }

    // Update data rak
    public function update(Request $request, $id)
    {
        $data = [
            'rak_nama' => $request->input('rak_nama'),
            'rak_lokasi' => $request->input('rak_lokasi'),
            'rak_kapasitas' => $request->input('rak_kapasitas'),
        ];

        Rak::where('rak_id', $id)->update($data);
        return redirect()->route('rak')->with('updated', 'Data rak berhasil diupdate!');
    }

    // Hapus data rak
    public function destroy($id)
    {
        Rak::where('rak_id', $id)->delete();
        return redirect()->route('rak')->with('deleted', 'Data rak berhasil dihapus!');
    }
}
