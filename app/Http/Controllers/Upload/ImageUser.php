<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ImageUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateImgUser(Request $request, $id)
    {

        $request->validate([
            'image' => 'image',
        ]);

        $foto_profile = $request->file('image');

        if ($foto_profile) {
            $nameImage = $request->image->getClientOriginalName() . '-' . time()
                . '.' .   $request->image->extension();


            $request->image->move(public_path('files/img-users'), $nameImage);
        }

        try {
            User::where('id', $id)
                ->update([
                    'image' => $nameImage
                ]);
            // $user = User::where('id', $id)->first();
            // $user->update($data);

            // alert()->success('Data Foto berhasil diubah', 'Success');
            return redirect('account');
        } catch (\Exception $e) {
            // alert()->success('Data Foto gagal diubah', 'Error');
            return redirect('index-read');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
