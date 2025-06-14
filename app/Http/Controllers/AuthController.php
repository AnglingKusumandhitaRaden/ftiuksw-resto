<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index()
    {
        // menampilkan view resources/views/auth/login.blade.php
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //validate digunakan untuk memastikan field2 yang di post, sesuai dengan keinginan. misal required, jika username tidak diisi, maka akan muncul pesan error field is required.
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        //jika password betul maka masuk ke halaman utama
        if (Auth::attempt($data)) {
            //akan dibuat session, supaya jika user masuk ke browser lagi, tidak perlu login ulang
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        //memberikan pesan error, jika user tidak ada
        return back()->with(
            'error', 'Username atau password salah.',
        );
    }

    public function logout(Request $request)
    {
        //keluar dari authentifikasi dan menghapus session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}