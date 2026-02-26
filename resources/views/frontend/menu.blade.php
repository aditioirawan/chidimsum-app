@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <h4 class="fw-bold">Menu ChiDimsum</h4>
    @if(session('cart'))
        <a href="{{ route('cart.view') }}" class="btn btn-warning rounded-pill">Keranjang ({{ count(session('cart')) }})</a>
    @endif
</div>

<h5 class="text-danger fw-bold mb-3">🥟 Dimsum Terlezat</h5>
<div class="row mb-5">
    @foreach($products->where('price', '>', 10000) as $product)
    <div class="col-6 col-md-3 mb-4">
        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
            <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" style="height:150px; object-fit:cover;" onerror="this.src='{{ asset('images/default_dimsum.jpg') }}'">
            <div class="card-body text-center p-2">
                <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                <p class="text-danger small fw-bold mb-2">Rp {{ number_format($product->price) }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn btn-danger btn-sm w-100 rounded-pill">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<h5 class="text-primary fw-bold mb-3">🥤 Minuman Segar</h5>
<div class="row">
    @foreach($products->where('price', '<=', 10000) as $product)
    <div class="col-6 col-md-3 mb-4">
        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
            <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" style="height:150px; object-fit:cover;" onerror="this.src='{{ asset('images/default_dimsum.jpg') }}'">
            <div class="card-body text-center p-2">
                <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                <p class="text-primary small fw-bold mb-2">Rp {{ number_format($product->price) }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn btn-primary btn-sm w-100 rounded-pill">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection