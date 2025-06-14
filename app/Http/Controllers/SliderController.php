<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        // mendapatkan semua data slider dari database. with ('user') adalah sebuah fungsi eager loading, menarik data relasi FK nya, sehingga bisa ditampilkan
        $sliders = Slider::with('user')->get();

        // mengirimkan data $sliders ke view menggunakan compact
        return view('sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('sliders.form');
    }

    public function store(Request $request)
    {
        // melakukan validasi biasa dengan aturan tertentu, jika sesuai maka akan tampil tampilan error
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // cek apakah ada file yang dikirim, jika ada maka akan disimpan di storage
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        //menambahkan field user_id melalui fungsi Auth::id, supaya kita tahu siapa yang input
        $validated['user_id'] = Auth::id();
        //melakukan penambahan data
        Slider::create($validated);

        //halaman di redirect ke slider.index, lalu ditampilkan pesan sukses ke view
        return redirect()->route('slider.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit(Slider $slider)
    {
        // $slider di dapat dari pengiriman parameter berupa object dari view
        return view('sliders.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // hapus file lama jika ada
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }

            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }
        $validated['user_id'] = Auth::id();

        //method untuk mengubah data
        $slider->update($validated);
        return redirect()->route('slider.index')->with('success', 'Slider berhasil diupdate.');
    }

    public function destroy(Slider $slider)
    {
        // $slider di dapat dari pengiriman parameter berupa object dari view
        // jika ada dan memiliki gambar tersebut, maka file akan dihapus
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider berhasil dihapus.');
    }
}