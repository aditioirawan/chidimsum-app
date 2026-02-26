@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold">Laporan Pendapatan</h4>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Kembali ke Dapur</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
                <tr><th>Tanggal</th><th>Total Pesanan</th><th>Total Uang Masuk</th></tr>
            </thead>
            <tbody>
                @foreach($reports as $rpt)
                <tr>
                    <td>{{ $rpt->date }}</td>
                    <td>{{ $rpt->total_orders }} Transaksi</td>
                    <td class="fw-bold text-success">Rp {{ number_format($rpt->total_income) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection