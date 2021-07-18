<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_pesanan',
        'tgl_testi',
        'kesan',
        'status_baca',
    ];
}
