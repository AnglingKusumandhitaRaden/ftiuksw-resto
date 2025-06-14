{{-- saya ubah m-5 menjadi mt-5 (hanya margin top saja yang ganti) --}}
<div class="container mt-5">
  <div class="row row-cols-1 row-cols-md-3 g-4">

      {{-- <div class="col">
        <div class="card h-100">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      </div> --}}

{{-- kita tidak memerlukan $key / index 
gambar sy style ulang, untuk menanggulangi beda ukuran
--}}
      @foreach($menus as $menu)
      <div class="col">
        <div class="card h-100">
          <img src="{{ asset("storage/" . $menu->image) }}" class="card-img-top" style="height: 200px; object-fit: cover; object-position: center;" alt="{{ $menu->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $menu->name }}</h5>
            <p class="card-text">{{ $menu->description }}</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">{{ $menu->updated_at }}</small>
          </div>
        </div>
      </div> 
      @endforeach
    </div>
</div>