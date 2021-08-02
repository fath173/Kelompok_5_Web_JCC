<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Account extends Controller
{
    public function index($id)
    {
        $user = User::where('id', $id)->get();

        return response()->json([
            'message' => 'success',
            'user' => $user,
        ], 201);
    }

    public function updatePhoto(Request $request, $id)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Foto tidak sesuai syarat'
            ], 401);
        }


        $image = $request->file('image');
        $nameImage = md5($image . microtime() . '.' . $image->extension());

        Storage::putFileAs(
            'public/img-users',
            $image,
            $nameImage
        );

        User::where('id', $id)
            ->update([
                'image' => $nameImage,
            ]);

        $response = [
            'message' => 'Berhasil perbarui foto profile'
        ];

        return response($response, 201);
    }

    public function updateBio(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'birthday' => 'required',
                'phone_number' => 'required',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Email sudah terpakai'
            ], 401);
        }


        User::where('id', $id)
            ->update($request->all());


        $response = [
            'message' => 'Data anda berhasil diperbarui',
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
        ];

        return response($response, 201);
    }
}
