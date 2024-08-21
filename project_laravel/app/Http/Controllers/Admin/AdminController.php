<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function login()
    {

        // User::create([
        //     'name' => 'Admin Manager1',
        //     'email' => 'admin1@gmail.com',
        //     'password' => bcrypt(111111)

        // ]);
        return view('admin.login');
    }



    public function check_login(Request $req)
    {
        //Log::info('Email input:', ['email' => $req->email]);
        $req->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $data = $req->only('email', 'password');

        //Log::info('Login Attempt Data:', $data);


        $check = auth()->attempt($data);


        if ($check) {
            return redirect()->route('admin.index')->with('ok', 'welcome back');
        }
        return redirect()->back()->with('no', 'your email or password is not match');
    }

    public function logout()
    {

        auth()->logout();
        return redirect()->route('admin.login')->with('ok', 'logout success');

    }
}
