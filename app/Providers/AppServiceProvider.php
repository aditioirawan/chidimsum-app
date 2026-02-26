<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
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
        // Log ini akan muncul di dashboard Render jika kodenya jalan
        Log::info('--- AppServiceProvider boot dijalankan ---');

        // Cek apakah tabel migrasi sudah ada, kalau belum, jalankan migrasi
        // Ini akan memaksa database terbuat otomatis saat website dibuka
        if (!Schema::hasTable('migrations')) {
            Artisan::call('migrate --force');
        }
    }
}