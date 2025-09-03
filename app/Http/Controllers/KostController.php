<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKostRequest;
use App\Http\Requests\UpdateKostRequest;
use App\Models\Category;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kosts = Kost::with(['user', 'rooms', 'tenants', 'categories'])
            ->withCount(['rooms', 'tenants' => function ($query) {
                $query->where('status', 'aktif');
            }])
            ->when(auth()->user()->id !== 1, function ($query) {
                // Non-admin users can only see their own kosts
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(12);

        $stats = [
            'total_kosts' => Kost::when(auth()->user()->id !== 1, function ($query) {
                $query->where('user_id', auth()->id());
            })->count(),
            'total_rooms' => auth()->user()->id === 1 
                ? \App\Models\Room::count()
                : \App\Models\Room::whereHas('kost', function ($query) {
                    $query->where('user_id', auth()->id());
                })->count(),
            'occupied_rooms' => auth()->user()->id === 1
                ? \App\Models\Room::where('status', 'terisi')->count()
                : \App\Models\Room::whereHas('kost', function ($query) {
                    $query->where('user_id', auth()->id());
                })->where('status', 'terisi')->count(),
            'total_tenants' => auth()->user()->id === 1
                ? \App\Models\Tenant::where('status', 'aktif')->count()
                : \App\Models\Tenant::whereHas('kost', function ($query) {
                    $query->where('user_id', auth()->id());
                })->where('status', 'aktif')->count(),
        ];

        return Inertia::render('kosts/index', [
            'kosts' => $kosts,
            'stats' => $stats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        
        return Inertia::render('kosts/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['name'] . '-' . random_int(1000, 9999));
        
        // Handle facilities as JSON
        if (isset($data['facilities'])) {
            $data['facilities'] = is_array($data['facilities']) 
                ? $data['facilities'] 
                : explode(',', $data['facilities']);
        }

        $kost = Kost::create($data);

        // Attach categories if provided
        if (isset($data['categories'])) {
            $kost->categories()->sync($data['categories']);
        }

        return redirect()->route('kosts.show', $kost)
            ->with('success', 'Kost berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kost $kost)
    {
        // Check authorization
        if (auth()->user()->id !== 1 && $kost->user_id !== auth()->id()) {
            abort(403);
        }

        $kost->load([
            'categories',
            'rooms' => function ($query) {
                $query->withCount(['tenants' => function ($q) {
                    $q->where('status', 'aktif');
                }]);
            },
            'tenants' => function ($query) {
                $query->where('status', 'aktif')->with('room');
            }
        ]);

        $roomStats = [
            'total' => $kost->rooms->count(),
            'occupied' => $kost->rooms->where('status', 'terisi')->count(),
            'available' => $kost->rooms->where('status', 'kosong')->count(),
            'booking' => $kost->rooms->where('status', 'booking')->count(),
        ];

        $recentPayments = \App\Models\Payment::where('kost_id', $kost->id)
            ->with(['tenant', 'room'])
            ->latest()
            ->limit(5)
            ->get();

        return Inertia::render('kosts/show', [
            'kost' => $kost,
            'roomStats' => $roomStats,
            'recentPayments' => $recentPayments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kost $kost)
    {
        // Check authorization
        if (auth()->user()->id !== 1 && $kost->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        $kost->load('categories');

        return Inertia::render('kosts/edit', [
            'kost' => $kost,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKostRequest $request, Kost $kost)
    {
        // Check authorization
        if (auth()->user()->id !== 1 && $kost->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validated();
        
        // Handle facilities as JSON
        if (isset($data['facilities'])) {
            $data['facilities'] = is_array($data['facilities']) 
                ? $data['facilities'] 
                : explode(',', $data['facilities']);
        }

        $kost->update($data);

        // Sync categories if provided
        if (isset($data['categories'])) {
            $kost->categories()->sync($data['categories']);
        }

        return redirect()->route('kosts.show', $kost)
            ->with('success', 'Kost berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kost $kost)
    {
        // Check authorization
        if (auth()->user()->id !== 1 && $kost->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if kost has active tenants
        if ($kost->tenants()->where('status', 'aktif')->count() > 0) {
            return redirect()->route('kosts.show', $kost)
                ->with('error', 'Tidak dapat menghapus kost yang masih memiliki penghuni aktif.');
        }

        $kost->delete();

        return redirect()->route('kosts.index')
            ->with('success', 'Kost berhasil dihapus.');
    }
}