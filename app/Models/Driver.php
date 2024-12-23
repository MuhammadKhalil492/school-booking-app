<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\DriverFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;
    /**
     * Fillable fields of this the table Drivers
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'vehicle_type',
        'vehicle_number',
        'license_number',
        'license_expiry',
        'profile_photo',
        'rating',
        'is_verified',
        'is_active',
    ];
    /**
     * User belong to driver
     *
     * @return void
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
