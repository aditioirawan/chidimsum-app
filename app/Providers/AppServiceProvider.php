<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Log ini saja yang kita simpan untuk memastikan kode terbaca
        // Kita HAPUS perintah Artisan::call('migrate') agar aplikasi tidak crash
        Log::info('--- AppServiceProvider boot dijalankan: Database migrasi dimatikan ---');
    }
}