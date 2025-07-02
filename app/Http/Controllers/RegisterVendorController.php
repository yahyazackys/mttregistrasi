<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterVendorController extends Controller
{
    public function showForm()
    {
        return view('auth.register_vendor');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:users',
            'pic_name' => 'required',
            'phone' => 'required',
            'password' => 'required|min:8',
            'terms' => 'accepted'
        ]);

        $user = User::create([
            'name' => $data['pic_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'vendor',
            'pic_name' => $data['pic_name'],
            'phone' => $data['phone'],
            'terms_agreed' => true
        ]);

        Auth::login($user);

        return redirect('/hotels');
    }
}
