@extends('layouts.index')

@section('content')
<div class="container">
    {{-- dibuat logika, jika ada object $slider yang dikirimkan dari controller makan halaman ini adalah edit, jika tidak adalah add. logika supaya hanya 1 halaman saja tapi dipakai add dan edit --}}
  <h2 class="mb-4">{{ isset($slider) ? 'Edit Slider' : 'Tambah Slider' }}</h2>
    {{-- logika supaya jika ada $slider yg dikirim dari controller, maka update sebaliknya add --}}
    {{-- perhatikan ada tipe enctype => jika upload file. jika tidak, maka seperti login tadi, tidak perlu diberikan tipe encriptionnya --}}
  <form method="POST" action="{{ isset($slider) ? route('slider.update', $slider) : route('slider.store') }}" enctype="multipart/form-data">
    {{-- untuk keamanan dari serangan csrf --}}
    @csrf
    {{-- html hanya mengenal get dan post. sehingga perlu ditambahkan fitur dari laravel untuk membuat route tau bahwa ini adalah fungsi PUT --}}
    @if(isset($slider))
      @method('PUT')
    @endif

    <div class="mb-3">
      <label for="name" class="form-label">Nama Slider</label>
      {{-- jika ada error name maka akan ditambahi sebuah html class yang akan membuat input menjadi berwarna merah. old data adalah sebuah penyimpanan sementara, jika ada error fungsi, maka user tidak perlu menulis ulang datanya --}}
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name', $slider->name ?? '') }}">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Gambar</label>
      <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
      @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror

      @if(isset($slider) && $slider->image)
        <p class="mt-2">Gambar saat ini:</p>
        <img src="{{ asset('storage/' . $slider->image) }}" width="200">
      @endif
    </div>

    {{-- jika ditekan maka data akan disubmit --}}
    <button type="submit" class="btn btn-success">Simpan</button>
    {{-- jika batal ke halaman index lagi --}}
    <a href="{{ route('slider.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
