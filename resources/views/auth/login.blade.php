<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="container mt-5">
    {{-- tambahkan alamat actionnya. di sini maka form akan melakukan check ke routes/web.php method post dengan nama route=login  --}}
    <form method="POST" action="{{ route('login') }}" class="mx-auto p-4 border rounded shadow" style="max-width: 400px;">
      @csrf
      <h1 class="h3 mb-3 text-center">Login</h1>
        {{-- logika digunakan menampilkan pesan error --}}
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

      <div class="form-floating mb-3">
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="username" >
        <label for="username">Username</label>
                {{-- logika digunakan menampilkan pesan error pada field --}}
        @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      {{-- saya tambahkan margin bottom 3, supaya ada jarak --}}
      <div class="form-floating mb-3">
        <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
                {{-- logika digunakan menampilkan pesan error pada field --}}        
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
         @enderror
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
  </main>
</body>
</html>
