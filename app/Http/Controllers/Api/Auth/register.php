<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class register extends Controller
{
    public function register(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Email sudah terpakai'
            ], 401);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'pelanggan',
        ]);

        // $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'message' => 'Silahkan konfirmasi pada email anda',
            // 'token' => $token,
        ];

        return response($response, 201);
    }
}
