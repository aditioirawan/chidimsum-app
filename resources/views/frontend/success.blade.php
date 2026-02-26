@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 text-center">
        <div class="card shadow-sm border-0 p-5 rounded-4">
            <div class="text-success mb-4"><i class="fas fa-check-circle fa-5x"></i></div>
            <h2 class="fw-bold text-success">Pesanan Terkirim!</h2>
            <div class="badge bg-danger fs-6 mb-4 px-3 py-2 rounded-pill">Meja {{ $order->table_number }}</div>

            @if($order->payment_method == 'tunai')
                <div class="alert alert-warning border-0 shadow-sm py-4">
                    <p class="mb-1 text-dark">Mohon siapkan uang tunai sebesar:</p>
                    <h3 class="fw-bold text-dark">Rp {{ number_format($order->total_price) }}</h3>
                    <p class="small mb-0 mt-3 text-muted">
                        Silakan berikan pembayaran kepada pelayan <br>
                        <strong>saat makanan diantar ke meja Anda</strong>.
                    </p>
                </div>
            @else
                <div class="alert alert-primary border-0 shadow-sm">
                    <p class="mb-0">Terima kasih! Pembayaran QRIS Anda berhasil. Pesanan segera diantar.</p>
                </div>
            @endif

            <a href="{{ route('menu.index') }}" class="btn btn-danger w-100 py-2 rounded-pill mt-4">Kembali ke Menu</a>
        </div>
    </div>
</div>
@endsection