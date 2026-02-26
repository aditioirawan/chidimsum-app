<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller {
    // Menampilkan daftar pesanan di dapur
    public function index() {
        // Mengambil pesanan terbaru beserta item dan produknya
        $orders = Order::with('items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Update status pesanan (misal: dari Pending ke Masak)
    public function updateStatus(Request $request, $id) {
        Order::findOrFail($id)->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status Pesanan Diperbarui!');
    }

    // Menghitung laporan pendapatan harian
    public function report() {
        $reports = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total_income, COUNT(*) as total_orders')
            ->where('status', 'paid') // Hanya yang sudah bayar
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();
        return view('admin.report', compact('reports'));
    }
}