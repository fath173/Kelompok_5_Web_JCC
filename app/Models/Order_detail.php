<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function variasi()
    {
        return $this->belongsTo(Product_variation::class, 'id_variasi', 'id');
    }
}
