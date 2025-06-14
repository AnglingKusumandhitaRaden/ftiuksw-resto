@extends('layouts.index')

@section('content')
<div class="container">
    <h2 class="mb-4">Master Slider</h2>
    {{-- nama route default dibuat sesuai nama yang di setting di routes/web.php. jika slider maka ada beberapa nama yaitu slider.store (Fungsi Create); slider.index(Fungsi read); slider.create(fungsi read halaman create), slider.update (update ) slider.edit (fungsi read halaman edit) dan slider.delete (fungsi delete) dll --}}
  <a href="{{ route('slider.create') }}" class="btn btn-primary mb-3">+ Tambah Slider</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Gambar</th>
        <th>User</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        {{-- melakukan perulangan $sliders (yang dikirim lewat controller tadi) --}}
      @foreach($sliders as $slider)
      <tr>
        <td>{{ $slider->name }}</td>
        <td>
            {{-- jika memiliki file image maka ditampilkan. string storage itu, dapat cek di public storage (symbolik link yang kita buat tadi), jadi laravel membuat link dari public ke storage (untuk keaman data) --}}
          @if($slider->image)
            <img src="{{ asset('storage/' . $slider->image) }}" width="150">
          @else
            <span class="text-muted">Tidak ada gambar</span>
          @endif
        </td>
        <td>
            {{-- keunggulan dari laravel yaitu eiger loading, yang mana dapat mengakses data FK nya tampa melakukan join --}}
            {{ $slider->user->username }}
        </td>        
        <td>
            {{-- menuju halaman edit dengan dikirimkan object $slider supaya bisa diterima di controller --}}
          <a href="{{ route('slider.edit', $slider) }}" class="btn btn-sm btn-warning">Edit</a>
          {{-- form menghapus data. di html tidak mengenal Delete, sehingga harus ditambahi fitur method DELETE dari laravel --}}
          <form action="{{ route('slider.destroy', $slider) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
            {{-- csrf untuk menghidari hacking csrf dengan memberikan token (untuk kemanan) --}}
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
