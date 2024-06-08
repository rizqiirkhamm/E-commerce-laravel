<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
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
        // dd($input);

        if($request->input('password'))
        {
            $input['password'] = $input['password'];
        }

        $validasi = Validator::make($input, [
            'name' => 'required|string|max:128',
            'level' => 'required',
            'email' => 'required|email|max:50',
            'password' => 'min:6|max:128'
        ]);
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        User::create($input);
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('user.detail',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);
        $data = $request->all();

        if (Arr::has($data, 'password')) {
            $data['password'] = Hash::make($data['password']);
        }
        $users->update($data);

        return redirect('/penjual');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);
        $users ->delete();
        return back();
    }
}
