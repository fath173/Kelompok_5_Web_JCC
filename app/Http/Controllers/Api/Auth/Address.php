<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Http;

class Address extends Controller
{
    protected $API_KEY = 'fc48250bb06d81db6029c405ac5c3ce4';

    public function dataProvince()
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        return response()->json([
            'message' => 'Berhasil mendapatkan Provinsi',
            'provinsi' => $provinces
        ]);
    }

    public function dataDistrict($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province=' . $id . '');

        $cities = $response['rajaongkir']['results'];

        return response()->json([
            'message' => 'Berhasil mendapatkan distrik',
            'distrik'    => $cities
        ]);
    }

    public function simpanAlamat(Request $request, $id)
    {
        try {
            $request->validate([
                'address' => 'required',
                'province' => 'required',
                'district' => 'required',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data Alamat Tidak Lengkap'
            ], 401);
        }

        User::where('id', $id)
            ->update($request->all());

        // $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'message' => 'Sukses Update Alamat',
            // 'token' => $token,
        ];

        return response($response, 201);
    }
}
