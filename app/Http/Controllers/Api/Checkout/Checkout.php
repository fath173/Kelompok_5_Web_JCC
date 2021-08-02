<?php

namespace App\Http\Controllers\Api\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product_variation as variations;

class Checkout extends Controller
{
    public function inputOrders(Request $request)
    {
        try {
            $request->validate([
                'id_user' => 'required',
                'ongkir' => 'required',
                'total' => 'required',
                'keterangan' => 'required',
                'alamat_kirim' => 'required',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data Inputan Tidak Valid'
            ], 401);
        }

        $allCart = $request->dataVariasi;
        foreach ($allCart as $var) {
            $variation = variations::find($var['id_variasi']);

            if ($variation->stok === 0) {
                return session()->flash('error', 'Stok 0 yahh');
            }
            $variation->decrement('stok', $var['jumlah']);
        }

        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $dataOrders = [
            'id_user' => $request->id_user,
            'tgl_pesan' => $waktu,
            'ongkir' => $request->ongkir, // INI PERLU DIKIRIM DATANYA
            'status' => 'belum bayar',
            'total' => $request->total,
            'keterangan' => $request->keterangan,
            'alamat_kirim' => $request->alamat_kirim,
        ];

        DB::beginTransaction();
        $orders = Order::create($dataOrders);

        foreach ($allCart as $variasi) {
            $dataDetail = [
                'id_pesanan' => $orders->id,
                'id_variasi' => $variasi['id_variasi'],
                'qty' => $variasi['jumlah'],
                'subtotal' => $variasi['subtotal'],
            ];
            $detailOrders = Order_detail::create($dataDetail);
        }

        if (!empty($orders) && !empty($detailOrders)) {
            DB::commit();
            return response()->json([
                'message' => 'Berhasil membuat pesanan',
            ], 201);
        } else {
            DB::rollBack();
            return response()->json([
                'message' => 'gagal input orders',
            ], 401);
        }
    }
}
