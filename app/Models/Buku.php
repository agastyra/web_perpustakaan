<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'buku_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'buku_id',
        'buku_penulis_id',
        'buku_penerbit_id',
        'buku_kategori_id',
        'buku_rak_id',
        'buku_judul',
        'buku_isbn',
        'buku_thnterbit',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'buku_kategori_id', 'kategori_id');
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'buku_penulis_id', 'penulis_id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'buku_penerbit_id', 'penerbit_id');
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'buku_rak_id', 'rak_id');
    }

    protected static function createBuku(array $data): void
    {
        try {
            DB::beginTransaction();
            $buku = self::create($data);
            if ($data["buku_urlgambar"]) {
                $path = $data["buku_urlgambar"]->store('gambar_buku');
                $buku->buku_urlgambar = $path;
                $buku->save();
            }
            DB::commit();
        } catch (\Throwable $throwable) {
            if (isset($path)) {
                Storage::delete($path);
            }
            DB::rollBack();
            throw new \Error($throwable->getMessage());
        }
    }

    protected static function readBuku()
    {
        $data = self::with(['penulis', 'penerbit', 'kategori', 'rak'])->paginate(10);
        return $data;
    }

    protected static function updateBuku($id, $data)
    {
        $buku = self::readBukuById($id);
        if ($buku) {
            DB::table('buku')->where('buku_id', $id)->update($data);
            return $buku;
        }
        return null;
    }

    protected static function readBukuById($id)
    {
        $buku = DB::table('buku')->where('buku_id', $id)->first();
        return $buku;
    }

    protected static function deleteBuku($id)
    {
        return DB::table('buku')->where('buku_id', $id)->delete();
    }

}
