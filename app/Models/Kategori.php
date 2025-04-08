<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kategori_id',
        'kategori_nama',
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'buku_kategori_id', 'kategori_id');
    }
}
