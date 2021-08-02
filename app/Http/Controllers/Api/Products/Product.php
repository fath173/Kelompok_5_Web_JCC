<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product as allProduct;
use App\Models\Product as VariasiModel;

class Product extends Controller
{


    public function index()
    {
        $product = allProduct::get();
        // return response()->json($product, 200);

        return response()->json([
            'message' => 'success Alhamdulilah',
            'data' => $product,
        ]);
    }

    public function detailProduct($id)
    {
        $details = VariasiModel::where('id', $id)->get();
        $stok = 0;
        $variasi = [];

        foreach ($details[0]->variasi as $detail) {
            $stok += $detail->stok;
            $variasi[] = [
                'id_variasi' => $detail->id,
                'nama_variasi' => $detail->nama_variasi,
                'berat' => $detail->berat,
                'stok' => $detail->stok,
                'harga' => $detail->harga,
            ];
        }

        return response()->json([
            'message' => 'success ambil detail',
            'totalStok' => $stok,
            'variasi' => $variasi,

        ]);
    }
}
