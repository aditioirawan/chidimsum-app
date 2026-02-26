@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <h3 class="fw-bold"><i class="fas fa-fire me-2"></i>Monitor Pesanan Dapur</h3>
    <a href="{{ route('admin.report') }}" class="btn btn-dark rounded-pill">Lihat Laporan Penjualan</a>
</div>

<div class="row">
    @foreach($orders as $order)
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header {{ $order->status == 'pending' ? 'bg-warning' : ($order->status == 'cooking' ? 'bg-primary text-white' : 'bg-success text-white') }}">
                <h5 class="mb-0">Meja {{ $order->table_number }} <span class="badge bg-light text-dark float-end small">{{ strtoupper($order->status) }}</span></h5>
            </div>
            <div class="card-body">
                <p class="small mb-1"><strong>Pemesan:</strong> {{ $order->customer_name }}</p>
                <p class="small text-muted mb-3">{{ $order->created_at->format('H:i') }} WIB</p>
                <ul class="list-group list-group-flush mb-3">
                    @foreach($order->items as $item)
                        <li class="list-group-item px-0 d-flex justify-content-between small">
                            <span>{{ $item->quantity }}x {{ $item->product->name }}</span>
                        </li>
                    @endforeach
                </ul>

                {{-- Tombol Alur Kerja Dapur --}}
                @if($order->status == 'pending')
                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                        @csrf <input type="hidden" name="status" value="cooking">
                        <button class="btn btn-primary w-100 rounded-pill">Mulai Masak</button>
                    </form>
                @elseif($order->status == 'cooking')
                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                        @csrf <input type="hidden" name="status" value="paid">
                        <button class="btn btn-success w-100 rounded-pill">Selesai & Tandai Bayar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection