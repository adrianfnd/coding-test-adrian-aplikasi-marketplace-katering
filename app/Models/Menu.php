<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'jenis_makanan_id',
        'nama',
        'deskripsi',
        'foto',
        'harga',
    ];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function jenisMakanan()
    {
        return $this->belongsTo(JenisMakanan::class);
    }
}
