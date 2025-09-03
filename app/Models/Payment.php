<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $invoice_number
 * @property int $kost_id
 * @property int $tenant_id
 * @property int $room_id
 * @property string $payment_type
 * @property string $period_month
 * @property int $period_year
 * @property \Illuminate\Support\Carbon $due_date
 * @property \Illuminate\Support\Carbon|null $payment_date
 * @property float $amount
 * @property float $paid_amount
 * @property string|null $payment_method
 * @property string $status
 * @property string|null $notes
 * @property array|null $payment_proof
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kost $kost
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\Room $room
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment pending()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment overdue()
 * @method static \Database\Factories\PaymentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'invoice_number',
        'kost_id',
        'tenant_id',
        'room_id',
        'payment_type',
        'period_month',
        'period_year',
        'due_date',
        'payment_date',
        'amount',
        'paid_amount',
        'payment_method',
        'status',
        'notes',
        'payment_proof',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'payment_date' => 'date',
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'payment_proof' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the kost that owns this payment.
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }

    /**
     * Get the tenant that owns this payment.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the room that belongs to this payment.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include overdue payments.
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue')
            ->orWhere(function ($q) {
                $q->where('status', 'pending')
                  ->where('due_date', '<', now()->toDateString());
            });
    }
}