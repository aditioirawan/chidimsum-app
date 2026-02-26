<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name'); // Nama Pemesan
            $table->integer('table_number')->default(0); // Nomor Meja
            $table->integer('total_price'); // Total Harga
            $table->string('payment_method'); // Tunai / Transfer
            $table->string('payment_proof')->nullable(); // Bukti Bayar (Opsional)
            // Status pesanan: pending (masuk), cooking (dimasak), served (disajikan), paid (selesai)
            $table->enum('status', ['pending', 'cooking', 'served', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};