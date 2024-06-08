<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
         // Validasi input
         $validator = Validator::make($data, [
            'nomor_hp' => 'required|numeric|min:10',
            'tgl_lahir' => 'required|date|',
            'jenis_kelamin' => 'required|',
            'icon_profile' => 'required|mimes:png,jpg,jpeg|',
            'alamat' => 'required|'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasFile('icon_profile'))
        {
            // Menentukan path penyimpanan file
            $path = 'public/images/profile';
            // Mengambil file yang diunggah
            $gambar = $request->file('icon_profile');
              // Mendapatkan nama asli file
            $nama_gambar = $gambar->getClientOriginalName();
             // Menyimpan file yang diunggah ke dalam direktori penyimpanan dengan nama asli
            $path = $request->file('icon_profile')->storeAs($path, $nama_gambar);
            // engunggah dan menyimpan file gambar ke server.
            $data['icon_profile'] = $nama_gambar;
        }
        Profile::create($data)->with('success', 'Data berhasil disimpan!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
