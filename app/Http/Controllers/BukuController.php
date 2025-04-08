<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Penerbit;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Support\Facades\Log;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::readBuku();
        return view('admin.admin_buku', compact('buku'));
    }

    public function showCreateForm()
    {
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        $rak = Rak::all();

        return view('admin.admin_create', compact('penulis', 'penerbit', 'kategori', 'rak'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'buku_judul' => 'required',
            'buku_isbn' => 'required',
            'buku_thnterbit' => 'required',
            'buku_penulis_id' => 'required',
            'buku_penerbit_id' => 'required',
            'buku_kategori_id' => 'required',
            'buku_rak_id' => 'required',
            'buku_urlgambar' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png']
        ]);

        $id = mt_rand(1000000000000000, 9999999999999999);
        $data['buku_id'] = $id;

        try {
            Buku::createBuku($data);
            return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('buku.index')->with('deleted', 'Buku gagal ditambahkan.');
        }
    }


    public function edit($id)
    {
        $buku = Buku::readBukuById($id);
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        $rak = Rak::all();

        return view('admin.admin_update_buku', compact('buku', 'penulis', 'penerbit', 'kategori', 'rak'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'buku_judul' => $request->input('buku_judul'),
            'buku_isbn' => $request->input('buku_isbn'),
            'buku_thnterbit' => $request->input('buku_thnterbit'),
            'buku_penulis_id' => $request->input('buku_penulis_id'),
            'buku_penerbit_id' => $request->input('buku_penerbit_id'),
            'buku_kategori_id' => $request->input('buku_kategori_id'),
            'buku_rak_id' => $request->input('buku_rak_id'),
        ];

        Buku::updateBuku($id, $data);
        return redirect()->route('buku.index')->with('updated', 'Data buku berhasil diupdate!');
    }

    public function destroy($id)
    {
        Buku::deleteBuku($id);
        return redirect()->route('buku.index')->with('deleted', 'Data buku berhasil dihapus!');
    }
}
