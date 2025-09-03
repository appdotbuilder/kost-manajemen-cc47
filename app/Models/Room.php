<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Room
 *
 * @property int $id
 * @property int $kost_id
 * @property string $room_number
 * @property string $floor
 * @property string|null $description
 * @property array|null $facilities
 * @property array|null $photos
 * @property float|null $size
 * @property float $monthly_price
 * @property float|null $quarterly_price
 * @property float|null $yearly_price
 * @property string $status
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kost $kost
 * @property-read \App\Models\Tenant|null $currentTenant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant> $tenants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Booking> $bookings
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room available()
 * @method static \Database\Factories\RoomFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kost_id',
        'room_number',
        'floor',
        'description',
        'facilities',
        'photos',
        'size',
        'monthly_price',
        'quarterly_price',
        'yearly_price',
        'status',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'facilities' => 'array',
        'photos' => 'array',
        'size' => 'decimal:2',
        'monthly_price' => 'decimal:2',
        'quarterly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the kost that owns this room.
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }

    /**
     * Get the current tenant for this room.
     */
    public function currentTenant(): HasOne
    {
        return $this->hasOne(Tenant::class)->where('status', 'aktif');
    }

    /**
     * Get all tenants for this room.
     */
    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }

    /**
     * Get the bookings for this room.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the payments for this room.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope a query to only include available rooms.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'kosong')->where('is_active', true);
    }
}