<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Tenant
 *
 * @property int $id
 * @property int $kost_id
 * @property int|null $room_id
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property string|null $address
 * @property string|null $id_number
 * @property string|null $emergency_contact_name
 * @property string|null $emergency_contact_phone
 * @property string|null $profession
 * @property array|null $documents
 * @property \Illuminate\Support\Carbon|null $check_in_date
 * @property \Illuminate\Support\Carbon|null $check_out_date
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kost $kost
 * @property-read \App\Models\Room|null $room
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant active()
 * @method static \Database\Factories\TenantFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Tenant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kost_id',
        'room_id',
        'name',
        'email',
        'phone',
        'address',
        'id_number',
        'emergency_contact_name',
        'emergency_contact_phone',
        'profession',
        'documents',
        'check_in_date',
        'check_out_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'documents' => 'array',
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the kost that owns this tenant.
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }

    /**
     * Get the room that belongs to this tenant.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the payments for this tenant.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope a query to only include active tenants.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }
}