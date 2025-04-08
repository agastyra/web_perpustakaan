<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "peminjaman_user_id" => ["required", "exists:users,id"],
            "peminjaman_tglpinjam" => ["required", "date"],
            "peminjaman_tglkembali" => ["required", "date"],
            "peminjaman_note" => ["required"],
            "peminjaman_detail.*.buku_id" => ["required", "exists:buku,buku_id"],
        ]);
        $data["peminjaman_denda"] = 0;

        try {
            Peminjaman::createPeminjaman($data, $data["peminjaman_detail"]);
            return response()->json(["status" => "success", "message" => "Peminjaman Berhasil Dibuat"]);
        } catch (\Exception $exception) {
            return response()->json(["status" => "error", "message" => $exception->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "peminjaman_user_id" => ["required", "exists:users,id"],
            "peminjaman_tglpinjam" => ["required", "date"],
            "peminjaman_tglkembali" => ["required", "date"],
            "peminjaman_note" => ["required"],
            "peminjaman_detail.*.buku_id" => ["required", "exists:buku,buku_id"],
            "peminjaman_denda" => ["nullable", "numeric"],
            "peminjaman_statuskembali" => ["nullable", "boolean"],
        ]);

        try {
            Peminjaman::updatePeminjaman($data, $data["peminjaman_detail"], $id);
            return response()->json(["status" => "success", "message" => "Peminjaman Berhasil Di-update"]);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            Peminjaman::deletePeminjaman($id);
            return redirect()->route("adminPeminjaman")->with(["success" => "Peminjaman Berhasil Dihapus"]);
        } catch (\Exception $e) {
            return redirect()->route("adminPeminjaman")->with(["deleted" => "Peminjaman Gagal Dihapus"]);
        }
    }
}
