<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class registerController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function register(Request $request){

        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8"
        ]);

        User::create($data);

        return redirect()->route('dashboard');

    }
}
