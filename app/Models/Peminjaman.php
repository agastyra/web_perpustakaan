<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'peminjaman_user_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'peminjaman_user_id',
        'peminjaman_tglpinjam',
        'peminjaman_tglkembali',
        'peminjaman_statuskembali',
        'peminjaman_note',
        'peminjaman_denda',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'peminjaman_user_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany(Peminjaman_Detail::class, 'peminjaman_detail_peminjaman_id', 'id');
    }

    protected static function createPeminjaman(array $data, array $peminjaman_detail): void
    {
        try {
            if (isset($data["peminjaman_detail"])) unset($data["peminjaman_detail"]);

            DB::beginTransaction();
            $peminjaman = DB::table("peminjaman")->insertGetId($data);
            foreach ($peminjaman_detail as $buku) {
                $dataBuku = [];
                $dataBuku["peminjaman_detail_buku_id"] = $buku["buku_id"];
                $dataBuku["peminjaman_detail_peminjaman_id"] = $peminjaman;
                DB::table("peminjaman_detail")->insert($dataBuku);
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Error($e->getMessage());
        }
    }

    protected static function updatePeminjaman(array $data, array $peminjaman_detail, $id): void
    {
        try {
            if (isset($data["peminjaman_detail"])) unset($data["peminjaman_detail"]);
            DB::beginTransaction();
            DB::table("peminjaman")->where('id', $id)->update($data);
            DB::table("peminjaman_detail")->where('peminjaman_detail_peminjaman_id', $id)->delete();
            foreach ($peminjaman_detail as $buku) {
                $dataBuku = [];
                $dataBuku["peminjaman_detail_buku_id"] = $buku["buku_id"];
                $dataBuku["peminjaman_detail_peminjaman_id"] = $id;
                DB::table("peminjaman_detail")->insert($dataBuku);
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Error($e->getMessage());
        }
    }

    protected static function deletePeminjaman($id): void
    {
        try {
            DB::beginTransaction();
            DB::table('peminjaman_detail')->where('peminjaman_detail_peminjaman_id', $id)->delete();
            DB::table('peminjaman')->where('id', $id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Error($e->getMessage());
        }
    }
}
