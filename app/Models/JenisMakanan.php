<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMakanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jenis_makanan',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
