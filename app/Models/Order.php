<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');

        // karena dari tabel foreign key  ke tabel induk maka pake belongsTo
        // lalu tentukan id pada foreign key, baru id dari induk
        // yang ditampilin Foreignkey dulu baru relasinya atau Induknya
    }

    public function orderDetail()
    {
        $detail = $this->hasMany(Order_detail::class, 'id_pesanan', 'id');
        // $detail = $this->hasManyThrough(Product_variation::class, Order_detail::class);
        // dd($order);

        // $asli = [
        //     'idVar' => $detail->id_variasi,
        // ];

        return $detail;
    }
}
