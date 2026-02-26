@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-danger text-white py-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-shopping-cart me-2"></i>Keranjang Pesanan</h5>
            </div>
            <div class="card-body p-4">
                @if(session('cart') && count(session('cart')) > 0)
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>Produk</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $details)
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block">{{ $details['name'] }}</span>
                                    </td>
                                    <td class="text-center">{{ $details['quantity'] }}x</td>
                                    <td class="text-end fw-bold">Rp {{ number_format($details['price'] * $details['quantity']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        tfoot
                            <tr class="border-top">
                                <td colspan="2" class="pt-3 fw-bold fs-5">Total</td>
                                <td class="pt-3 text-end fw-bold fs-5 text-danger">
                                    Rp {{ number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity'])) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <hr class="my-4">

                    <form action="{{ route('order.checkout') }}" method="POST">
                        @csrf
                        <h6 class="fw-bold mb-3"><i class="fas fa-user-edit me-2"></i>Informasi Pelanggan</h6>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-8">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" name="customer_name" class="form-control rounded-pill" placeholder="Masukkan nama kamu" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Nomor Meja</label>
                                <input type="number" name="table_number" class="form-control rounded-pill" placeholder="Contoh: 5" required>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3"><i class="fas fa-wallet me-2"></i>Pilih Metode Pembayaran</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-check border rounded-3 p-3 shadow-sm h-100">
                                    <input class="form-check-input ms-0 me-2" type="radio" name="payment_method" id="qris" value="qris" checked>
                                    <label class="form-check-label" for="qris">
                                        <span class="d-block fw-bold"><i class="fas fa-qrcode text-primary"></i> QRIS</span>
                                        <small class="text-muted">Bayar langsung lewat HP</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border rounded-3 p-3 shadow-sm h-100">
                                    <input class="form-check-input ms-0 me-2" type="radio" name="payment_method" id="tunai" value="tunai">
                                    <label class="form-check-label" for="tunai">
                                        <span class="d-block fw-bold text-success"><i class="fas fa-money-bill-wave"></i> Tunai</span>
                                        <small class="text-muted">Bayar pas makanan datang</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 rounded-pill py-3 fw-bold shadow-sm">
                            <i class="fas fa-paper-plane me-2"></i> KONFIRMASI PESANAN
                        </button>
                    </form>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-basket fa-3x text-light mb-3"></i>
                        <p class="text-muted">Keranjang kamu masih kosong.</p>
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-danger rounded-pill">Kembali Belanja</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection