@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-danger text-white text-center py-3">
                <h5 class="fw-bold mb-0">Konfirmasi Pembayaran</h5>
            </div>
            
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill small">
                        Meja {{ $order->table_number }} | ID: #{{ $order->id }}
                    </span>
                </div>

                @if($order->payment_method == 'qris')
                    <h6 class="text-muted mb-3 small">Scan QRIS di bawah ini:</h6>
                    <div class="bg-white p-2 border rounded d-inline-block mb-3 shadow-sm">
                        <img src="{{ asset('images/qris.jpg') }}" alt="QR Code" class="img-fluid" style="width: 200px;">
                    </div>
                    <div class="alert alert-warning py-2 small">
                        <i class="fas fa-info-circle me-1"></i> Screenshot bukti bayar ini.
                    </div>
                @endif

                <h2 class="fw-bold text-danger my-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                
                <hr class="border-secondary border-opacity-25 border-dashed">
                
                <div class="text-start mb-4">
                    <p class="small text-muted fw-bold mb-2 uppercase">Ringkasan Pesanan</p>
                    <ul class="list-unstyled small">
                        @foreach($order->items as $item)
                        <li class="d-flex justify-content-between mb-1">
                            <span>{{ $item->quantity }}x {{ $item->product->name }}</span>
                            <span>{{ number_format($item->price * $item->quantity) }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <form action="{{ route('order.complete', $order->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger w-100 py-3 rounded-pill fw-bold shadow-sm">
                        <i class="fas fa-check-circle me-2"></i> Konfirmasi Selesai
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection