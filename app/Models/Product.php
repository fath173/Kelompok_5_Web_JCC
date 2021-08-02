<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['nama_produk', 'gambar', 'gambar_mobile', 'deskripsi'];

    public function variasi()
    {
        return $this->hasMany(Product_variation::class, 'id_produk', 'id');
        //kalo dari induk ke tabel foreign key pake HasMany untuk relasi
        // yang ditampilin Induknya dulu baru relasinya atau Foreignkey
    }
}
