<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Toko::all();
        $user = User::all();
        return view('toko.index', compact('toko', 'user'));
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
    $input = $request->all();

    $validasi = Validator::make($input, [
        'nama_toko' => 'required|max:128|string|min:5',
        'desc_toko' => 'required',
        'kategori_toko' => 'required',
        'hari_buka' => 'required|array',
        'jam_libur' => 'required|date_format:H:i',
        'jam_buka' => 'required|date_format:H:i',
        'icon_toko' => 'required|mimes:jpeg,jpg,png,svg|max:5048',
    ]);

    if ($validasi->fails()) {
        return back()->withErrors($validasi)->withInput();
    }

    // Konversi nilai array hari_buka ke string
    $input['hari_buka'] = implode(',', $request->input('hari_buka'));

    if ($request->hasFile('icon_toko')) {
        // Menentukan path penyimpanan file
        $path = 'public/images/toko';
        // Mengambil file yang diunggah
        $gambar = $request->file('icon_toko');
        // Mendapatkan nama asli file
        $nama_gambar = $gambar->getClientOriginalName();
        // Menyimpan file yang diunggah ke dalam direktori penyimpanan dengan nama asli
        $path = $request->file('icon_toko')->storeAs($path, $nama_gambar);
        // Mengunggah dan menyimpan file gambar ke server.
        $input['icon_toko'] = $nama_gambar;
    }

    // Menyimpan data ke database
    Toko::create($input);

    return back();
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Toko::find($id);
        return view('toko.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
   {
       $toko = Toko::findOrFail($id);
       $data = $request->except('hari_buka');
       $data['hari_buka'] = implode(',', $request->input('hari_buka', []));

       if($request->hasFile('icon_toko')){

        // Validasi type File dan ukuran yang diperlukan
        $request->validate([
            'icon_toko' => 'required|mimes:png,jpg,jpeg,svg|max:5048',
        ]);

        // Hapus gambar lama
        if($toko->icon_toko){
            $Filelama = 'public/images/toko/' . $toko->icon_toko;
            Storage::delete($Filelama);
        }

        // Simpan gambar baru
        $gambar = $request->file('icon_toko');
        $nama_gambar = $gambar->getClientOriginalName();
        $gambar->storeAs('public/images/toko', $nama_gambar);

        // update gambar baru ke database
        $data['icon_toko'] = $nama_gambar;
       }

        // dd($data);

        // Update data baru
       $toko->update($data);

       return redirect('/toko');
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $input = explode(',', $id);
        $input = Toko::find($id);
        $image_path = public_path('public/images/toko/' . $input->icon_toko);

        if(file_exists($image_path)){
            unlink($image_path);
        }
        $input ->delete();
        return back();
        
    }
}
