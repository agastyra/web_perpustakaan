<?php
namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function showCreateForm()
    {
        return view('admin.create_penerbit');
    }

    public function readpenerbit()
    {
        $penerbit = Penerbit::readPenerbit();

        return view('admin.admin_penerbit', compact('penerbit'));
    }

    public function store(Request $request)
    {
        $id = mt_rand(1000000000000000, 9999999999999999);

        $data = $request->validate([
            'penerbit_nama'   => ['required', 'string', 'max:255'],
            'penerbit_alamat' => ['required', 'string', 'max:255'],
            'penerbit_notelp' => ['required', 'string', 'max:15', 'unique:penerbit,penerbit_notelp'],
            'penerbit_email'  => ['required', 'string', 'email', 'max:255', 'unique:penerbit,penerbit_email'],
        ]);
        $data['penerbit_id'] = $id;

        Penerbit::createPenerbit($data);
        return redirect()->route('penerbit')->with('success', 'Data penerbit berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penerbit = Penerbit::readPenerbitById($id);
        return view('admin.admin_update_penerbit', compact('penerbit'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'penerbit_id'     => $id,
            'penerbit_nama'   => $request->input('penerbit_nama'),
            'penerbit_alamat' => $request->input('penerbit_alamat'),
            'penerbit_notelp' => $request->input('penerbit_notelp'),
            'penerbit_email'  => $request->input('email'),
        ];
        
        Penerbit::updatePenerbit($id, $data);
        return redirect()->route('penerbit')->with('updated', 'Data penerbit berhasil diupdate!');
    }

    public function destroy($id)
    {
        Penerbit::deletePenerbit($id);
        return redirect()->route('penerbit')->with('deleted', 'Data penerbit berhasil dihapus!');
    }

}
