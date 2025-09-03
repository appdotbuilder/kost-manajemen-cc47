<?php

use App\Http\Controllers\KostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $user = auth()->user();
        
        // Get user's kosts with basic stats
        $kosts = \App\Models\Kost::when($user->id !== 1, function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->withCount(['rooms', 'tenants' => function ($query) {
            $query->where('status', 'aktif');
        }])
        ->latest()
        ->limit(6)
        ->get();

        // Calculate dashboard stats
        $stats = [
            'total_kosts' => \App\Models\Kost::when($user->id !== 1, function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count(),
            'total_rooms' => $user->id === 1 
                ? \App\Models\Room::count()
                : \App\Models\Room::whereHas('kost', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count(),
            'occupied_rooms' => $user->id === 1
                ? \App\Models\Room::where('status', 'terisi')->count()
                : \App\Models\Room::whereHas('kost', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->where('status', 'terisi')->count(),
            'total_tenants' => $user->id === 1
                ? \App\Models\Tenant::where('status', 'aktif')->count()
                : \App\Models\Tenant::whereHas('kost', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->where('status', 'aktif')->count(),
            'monthly_revenue' => 0, // Will be calculated from payments
            'pending_payments' => 0, // Will be calculated from payments
        ];
        
        return Inertia::render('dashboard', [
            'kosts' => $kosts,
            'stats' => $stats,
        ]);
    })->name('dashboard');

    // Kost management routes
    Route::resource('kosts', KostController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
