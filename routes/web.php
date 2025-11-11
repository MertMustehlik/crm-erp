<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

Route::get('/', fn(): RedirectResponse => redirect()->to('/admin'));

Route::get('/fresh-migrate/063f95ae-cd11-421d-b017-e276120b1a38-add31f0c-e68c-4062-b6ca-eb3acc988846', function () {
    Log::info('migrate:fresh çalıştı');

    Artisan::call('migrate:fresh', [
        '--seed' => true,
        '--force' => true, // Production'da çalışmasına izin vermek için
    ]);

    $time = Carbon::now()->format('Y-m-d H:i:s');
    return "✅ migrate:fresh --seed başarıyla çalıştırıldı! <br> {$time}";
});
