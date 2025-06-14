@extends('layouts.index')

@section('content')
<div class="container">
    {{-- dibuat logika, jika ada object $menu yang dikirimkan dari controller makan halaman ini adalah edit, jika tidak adalah add. logika supaya hanya 1 halaman saja tapi dipakai add dan edit --}}
  <h2 class="mb-4">{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu' }}</h2>
    {{-- logika supaya jika ada $menu yg dikirim dari controller, maka update sebaliknya add --}}
    {{-- perhatikan ada tipe enctype => jika upload file. jika tidak, maka seperti login tadi, tidak perlu diberikan tipe encriptionnya --}}
  <form method="POST" action="{{ isset($menu) ? route('menu.update', $menu) : route('menu.store') }}" enctype="multipart/form-data">
    {{-- untuk keamanan dari serangan csrf --}}
    @csrf
    {{-- html hanya mengenal get dan post. sehingga perlu ditambahkan fitur dari laravel untuk membuat route tau bahwa ini adalah fungsi PUT --}}
    @if(isset($menu))
      @method('PUT')
    @endif

    <div class="mb-3">
      <label for="name" class="form-label">Nama Menu</label>
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name', $menu->name ?? '') }}">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi Menu</label>
      <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror"
             value="{{ old('description', $menu->description ?? '') }}">
      @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="image" class="form-label">Gambar</label>
      <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
      @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror

      @if(isset($menu) && $menu->image)
        <p class="mt-2">Gambar saat ini:</p>
        <img src="{{ asset('storage/' . $menu->image) }}" width="200">
      @endif
    </div>

    {{-- jika ditekan maka data akan disubmit --}}
    <button type="submit" class="btn btn-success">Simpan</button>
    {{-- jika batal ke halaman index lagi --}}
    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
