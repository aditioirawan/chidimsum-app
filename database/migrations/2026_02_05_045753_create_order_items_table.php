<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // FK ke tabel orders (Kunci Tamu)
            // Kalau order dihapus, itemnya ikut terhapus (cascade)
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            // FK ke tabel products
            $table->foreignId('product_id')->constrained('products');
            
            $table->integer('quantity'); // Jumlah beli
            $table->integer('price'); // Harga saat beli
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};