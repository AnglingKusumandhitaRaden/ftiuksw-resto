<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Slider;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // kalau menggunakan get, kita akan mendapatkan collection
        
        // sehingga kalau hendak mengakses harus diakses tiap arraynya
        // misal slider[0]->name; slider[1]->name dst
        // limit 6 artinya menampilkan 6 data maksimal

        // jika kita mau menampilkan single data
        // misal 
        // $slider = Slider::find($id);
        // maka kita bisa akses langsung $slider->name

        // jika mau melakukan debug (testing hasilnya) ketik
        // dd($nilai);
        // atau 
        // dd("test");
        $data = [
            "sliders" => Slider::get(),
            "menus" => Menu::limit(6)->get(),      
        ];
        
        return view('landing-page.index', $data );
    }
}