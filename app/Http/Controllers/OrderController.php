<?php

namespace App\Http\Controllers;

use App\Models\{Product, Order, OrderItem};
use Illuminate\Http\Request;

class OrderController extends Controller {
    
    public function index(Request $request) {
        $products = Product::all();
        return view('frontend.menu', compact('products'));
    }

    public function addToCart(Request $request) {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($request->product_id);
        
        $cart[$product->id] = [
            "name" => $product->name, 
            "quantity" => ($cart[$product->id]['quantity'] ?? 0) + 1,
            "price" => $product->price, 
            "image" => $product->image
        ];
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu ditambahkan!');
    }

    public function checkout(Request $request) {
        // CEK KERANJANG: Agar tidak error "null given"
        if (!session('cart')) {
            return redirect()->route('menu.index')->with('error', 'Keranjang belanja kosong!');
        }

        // Simpan data order utama
        $order = Order::create([
            'customer_name'  => $request->customer_name,
            'table_number'   => $request->table_number, // Mengambil input meja manual
            'total_price'    => $this->calculateTotal(),
            'payment_method' => $request->payment_method,
            'status'         => 'pending'
        ]);

        // Simpan detail item
        foreach(session('cart') as $id => $details) {
            OrderItem::create([
                'order_id'   => $order->id, 
                'product_id' => $id, 
                'quantity'   => $details['quantity'], 
                'price'      => $details['price']
            ]);
        }

        // Bersihkan keranjang
        session()->forget('cart');

        // LOGIKA PEMBAYARAN:
        if ($request->payment_method == 'qris') {
            // Jika QRIS, ke halaman barcode
            return redirect()->route('order.payment', $order->id);
        } 
        
        // Jika Tunai, LANGSUNG ke halaman sukses
        return redirect()->route('order.success', $order->id);
    }

    public function payment($id) {
        $order = Order::findOrFail($id);
        return view('frontend.payment', compact('order'));
    }

    public function complete($id) { 
        return redirect()->route('order.success', $id); 
    }

    public function success($id) {
        // Fix error "Undefined variable $order"
        $order = Order::findOrFail($id);
        return view('frontend.success', compact('order'));
    }

    private function calculateTotal() {
        $total = 0;
        foreach(session('cart', []) as $item) { 
            $total += $item['price'] * $item['quantity']; 
        }
        return $total;
    }
}