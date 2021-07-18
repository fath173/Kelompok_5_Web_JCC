<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_gambar',
        'gambar',
        'tgl_gambar',
        'deskripsi',
    ];
}
