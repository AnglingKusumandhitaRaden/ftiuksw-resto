@extends('layouts.index')

@section('content')
<div class="container">
    <h2 class="mb-4">Master Menu</h2>
    {{-- nama route default dibuat sesuai nama yang di setting di routes/web.php. jika menu maka ada beberapa nama yaitu menu.store (Fungsi Create); menu.index(Fungsi read); menu.create(fungsi read halaman create), menu.update (update ) menu.edit (fungsi read halaman edit) dan menu.delete (fungsi delete) dll --}}
  <a href="{{ route('menu.create') }}" class="btn btn-primary mb-3">+ Tambah Menu</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Deskripsi</th>        
        <th>Gambar</th>
        <th>User</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        {{-- melakukan perulangan $menus (yang dikirim lewat controller tadi) --}}
      @foreach($menus as $menu)
      <tr>
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->description }}</td>        
        <td>
            {{-- jika memiliki file image maka ditampilkan. string storage itu, dapat cek di public storage (symbolik link yang kita buat tadi), jadi laravel membuat link dari public ke storage (untuk keaman data) --}}
          @if($menu->image)
            <img src="{{ asset('storage/' . $menu->image) }}" width="150">
          @else
            <span class="text-muted">Tidak ada gambar</span>
          @endif
        </td>
        <td>
            {{-- keunggulan dari laravel yaitu eiger loading, yang mana dapat mengakses data FK nya tampa melakukan join --}}
            {{ $menu->user->username }}
        </td>        
        <td>
            {{-- menuju halaman edit dengan dikirimkan object $menu supaya bisa diterima di controller --}}
          <a href="{{ route('menu.edit', $menu) }}" class="btn btn-sm btn-warning">Edit</a>
          {{-- form menghapus data. di html tidak mengenal Delete, sehingga harus ditambahi fitur method DELETE dari laravel --}}
          <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
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
