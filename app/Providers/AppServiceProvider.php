<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void { }

    public function boot(): void
    {
        // KOSONGKAN SAJA agar aplikasi tidak pusing melakukan migrasi otomatis
        Log::info('--- AppServiceProvider: Database logic disabled to prevent connection errors ---');
    }
}