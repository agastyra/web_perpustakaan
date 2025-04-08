<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function readkategori()
    {
        $kategori = Kategori::all();
        return view('admin.admin_kategori', compact('kategori'));
    }

    // Menampilkan form tambah kategori
    public function showCreateForm()
    {
        return view('admin.admin_create_kategori');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_nama' => 'required',
        ]);
        $data["kategori_id"] = mt_rand(1000000000000000, 9999999999999999);

        Kategori::create($data);
        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.admin_update_kategori', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_nama' => 'required',
        ]);

        Kategori::where('kategori_id', $id)->update($request->only('kategori_nama'));
        return redirect()->route('kategori')->with('updated', 'Kategori berhasil diupdate!');
    }

    // Hapus kategori
    public function destroy($id)
    {
        Kategori::where('kategori_id', $id)->delete();
        return redirect()->route('kategori')->with('deleted', 'Kategori berhasil dihapus!');
    }
}
