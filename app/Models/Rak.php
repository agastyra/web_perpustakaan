<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;
    protected $table = 'rak';
    protected $primaryKey = 'rak_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'rak_id',
        'rak_nama',
        'rak_lokasi',
        'rak_kapasitas',
    ];
    public function buku() {
        return $this->hasMany(Buku::class, 'buku_rak_id', 'rak_id');
    }
}
