<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Kost
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string|null $phone
 * @property string|null $email
 * @property array|null $photos
 * @property string|null $description
 * @property string|null $rules
 * @property array|null $facilities
 * @property string $gender_type
 * @property string $kost_type
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Room> $rooms
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant> $tenants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Booking> $bookings
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kost query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kost active()
 * @method static \Database\Factories\KostFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Kost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'photos',
        'description',
        'rules',
        'facilities',
        'gender_type',
        'kost_type',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'photos' => 'array',
        'facilities' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the kost.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the categories for this kost.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'kost_categories');
    }

    /**
     * Get the rooms for this kost.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Get the tenants for this kost.
     */
    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }

    /**
     * Get the bookings for this kost.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the payments for this kost.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope a query to only include active kosts.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}