<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;

class PenulisController extends Controller
{
    public function showCreateForm()
    {
        return view('admin.admin_create_penulis');
    }

    public function readpenulis()
    {
        $penulis = Penulis::all();
        return view('admin.admin_penulis', compact('penulis'));
    }

    public function store(Request $request)
    {
        $id = mt_rand(1000000000000000, 9999999999999999);

        $data = [
            'penulis_id' => $id,
            'penulis_nama' => $request->input('penulis_nama'),
            'penulis_tmptlahir' => $request->input('penulis_tmptlahir'),
            'penulis_tgllahir' => $request->input('penulis_tgllahir'),
        ];

        Penulis::create($data);
        return redirect()->route('penulis')->with('success', 'Data penulis berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penulis = Penulis::find($id);
        return view('admin.admin_update_penulis', compact('penulis'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'penulis_nama' => $request->input('penulis_nama'),
            'penulis_tmptlahir' => $request->input('penulis_tmptlahir'),
            'penulis_tgllahir' => $request->input('penulis_tgllahir'),
        ];

        Penulis::where('penulis_id', $id)->update($data);
        return redirect()->route('penulis')->with('updated', 'Data penulis berhasil diupdate!');
    }

    public function destroy($id)
    {
        Penulis::where('penulis_id', $id)->delete();
        return redirect()->route('penulis')->with('deleted', 'Data penulis berhasil dihapus!');
    }
}
