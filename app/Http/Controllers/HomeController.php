<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $data_profile = Profile::where('id_user', auth()->user()->id)->get()->all();
        return view('dashboard', compact('data_profile'));
    }


}
