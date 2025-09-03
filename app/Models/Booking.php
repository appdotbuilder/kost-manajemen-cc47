<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Booking
 *
 * @property int $id
 * @property string $booking_code
 * @property int $kost_id
 * @property int $room_id
 * @property string $customer_name
 * @property string|null $customer_email
 * @property string $customer_phone
 * @property \Illuminate\Support\Carbon $booking_date
 * @property \Illuminate\Support\Carbon $check_in_date
 * @property int $duration_months
 * @property float $total_amount
 * @property float $deposit_amount
 * @property string $status
 * @property string|null $notes
 * @property array|null $payment_proof
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kost $kost
 * @property-read \App\Models\Room $room
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking pending()
 * @method static \Database\Factories\BookingFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'booking_code',
        'kost_id',
        'room_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'booking_date',
        'check_in_date',
        'duration_months',
        'total_amount',
        'deposit_amount',
        'status',
        'notes',
        'payment_proof',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'booking_date' => 'date',
        'check_in_date' => 'date',
        'total_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'payment_proof' => 'array',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the kost that owns this booking.
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }

    /**
     * Get the room that belongs to this booking.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}