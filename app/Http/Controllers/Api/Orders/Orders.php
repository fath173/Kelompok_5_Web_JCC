<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order as AllOrder;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product_variation as variations;

class Orders extends Controller
{
    public function index($id)
    {
        $order = AllOrder::with(['orderDetail'])->orderBy('id', 'DESC')->where('id_user', $id)->get();
        $product = DB::table('product_variations')
            ->Join('products', 'product_variations.id_produk', '=', 'products.id')
            ->select('product_variations.id', 'gambar_mobile', 'nama_produk', 'nama_variasi', 'berat', 'harga')
            ->get();

        return response()->json([
            'message' => 'Success data pesanan',
            'allproduct' => $product,
            'allOrders' => $order,
            // 'detailOrders' => $deta,
        ]);
    }

    public function detailOrders($id)
    {
        $ordersDetail = DB::table('order_details')
            ->Join(
                'product_variations',
                'order_details.id_variasi',
                '=',
                'product_variations.id',
            )->Join(
                'products',
                'product_variations.id_produk',
                '=',
                'products.id',
            )->where('order_details.id_pesanan', '=', $id)
            ->get();

        $subtotal = 0;
        foreach ($ordersDetail as $detail) {
            $subtotal += $detail->subtotal;
        }
        return [
            'message' => 'Success Detail orders',
            'rincianOrder' => $ordersDetail,
            'subTotal' => $subtotal,
            'testi' => $this->findTesti($id),
        ];
    }


    public function updateTesti(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required',
            'kesan' => 'required',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        Testimonial::create([
            'id_user' => $request->id_user,
            'id_pesanan' => $id,
            'tgl_testi' => $waktu,
            'kesan' => $request->kesan,
            'status_baca' => 'Yes',
        ]);
        return response()->json([
            'message' => 'Testimoni berhasil'
        ]);
    }

    public function findTesti($id)
    {
        $testi = DB::select('select id_pesanan from testimonials where id_pesanan = ' . $id);
        if (!empty($testi)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function cancelOrder($id)
    {
        $data = Order_detail::where('id_pesanan', $id)->get();
        foreach ($data as $item) {
            $variation = variations::find($item['id_variasi']);
            $variation->increment('stok', $item['qty']);
        }

        AllOrder::where('id', $id)
            ->update([
                'status' => 'dibatalkan',
                'alasan' => 'Dibatalkan Pelanggan'
            ]);

        return response()->json([
            'message' => 'Pesanan dibatalkan'
        ]);
    }

    public function confirmOrder($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        AllOrder::where('id', $id)
            ->update([
                'tgl_terima' => $waktu,
                'status' => 'selesai'
            ]);
        return response()->json([
            'message' => 'Pesanan telah diterima'
        ]);
    }


    public function payment(Request $request, $id)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gambar tidak memenuhi syarat'
            ], 401);
        }

        $image = $request->file('image');
        $nameImage = md5($image . microtime() . '.' . $image->extension());

        Storage::putFileAs(
            'public/payment',
            $image,
            $nameImage
        );

        AllOrder::where('id', $id)
            ->update([
                'bukti_bayar' => $nameImage,
                'status' => 'verifikasi',
            ]);

        return response()->json([
            'message' => 'Berhasil Upload Image',
        ], 201);
    }
}
