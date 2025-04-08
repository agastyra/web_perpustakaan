<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    use HasFactory;
    protected $table = 'penulis';
    protected $primaryKey = 'penulis_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'penulis_id',
        'penulis_nama',
        'penulis_tmptlahir',
        'penulis_tgllahir',
    ];
    public function buku() {
        return $this->hasMany(Buku::class, 'buku_penulis_id', 'penulis_id');
    }
}
