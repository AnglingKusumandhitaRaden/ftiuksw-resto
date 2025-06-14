<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        // mendapatkan semua data menu dari database. with ('user') adalah sebuah fungsi eager loading, menarik data relasi FK nya, sehingga bisa ditampilkan
        $menus = Menu::with('user')->get();

        // mengirimkan data $menus ke view menggunakan compact
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.form');
    }

    public function store(Request $request)
    {
        // melakukan validasi biasa dengan aturan tertentu, jika sesuai maka akan tampil tampilan error
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',                 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // cek apakah ada file yang dikirim, jika ada maka akan disimpan di storage
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        //menambahkan field user_id melalui fungsi Auth::id, supaya kita tahu siapa yang input
        $validated['user_id'] = Auth::id();
        //melakukan penambahan data
        Menu::create($validated);

        //halaman di redirect ke menu.index, lalu ditampilkan pesan sukses ke view
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        // $menu di dapat dari pengiriman parameter berupa object dari view
        return view('menus.form', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',            
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // hapus file lama jika ada
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }

            $validated['image'] = $request->file('image')->store('menus', 'public');
        }
        $validated['user_id'] = Auth::id();

        //method untuk mengubah data
        $menu->update($validated);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy(Menu $menu)
    {
        // $menu di dapat dari pengiriman parameter berupa object dari view
        // jika ada dan memiliki gambar tersebut, maka file akan dihapus
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}