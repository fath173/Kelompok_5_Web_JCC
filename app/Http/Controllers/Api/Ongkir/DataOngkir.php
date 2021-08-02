<?php

namespace App\Http\Controllers\Api\Ongkir;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Frontend\Ongkir\DataOngkir as ongkosKirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class DataOngkir extends Controller
{

    public function dataOngkir(Request $request)
    {
        try {
            $request->validate([
                'district' => 'required',
                'sumweight' => 'required',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 401);
        }

        $origin = 160;
        $jne = Http::withHeaders([
            'key' => "fc48250bb06d81db6029c405ac5c3ce4"
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin'            => $origin,
            'destination'       => $request->district,
            'weight'            => $request->sumweight,
            'courier'           => 'jne'
        ]);

        $result = $jne['rajaongkir']['results'];
        $data = [];
        foreach ($result[0]['costs'] as $key => $row) {
            $data[] = [
                'idkurir' => $key,
                'kurir' => $result[0]['code'],
                'servis' => $row['service'],
                'biaya' => $row['cost'][0]['value'],
                'estimasi' => $row['cost'][0]['etd']
            ];
        }

        return response()->json([
            'message' => 'Success ambil data ongkir',
            'dataongkir' => $data,
        ], 200);
    }
}
