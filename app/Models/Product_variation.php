<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_produk',
        'nama_variasi',
        'berat',
        'stok',
        'harga',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
        // karena dari tabel foreign key  ke tabel induk maka pake belongsTo
        // lalu tentukan id pada foreign key, baru id dari induk
        // yang ditampilin Foreignkey dulu baru relasinya atau Induknya
    }
    public function ordersDetail()
    {
        return $this->hasMany(Order_detail::class, "id_variasi", "id");
    }
}
