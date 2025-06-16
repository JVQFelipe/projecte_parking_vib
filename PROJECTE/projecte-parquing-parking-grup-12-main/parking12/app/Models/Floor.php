<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'latitude','longitude', 'capacity', 'isOpen'];

    public function parking(): BelongsTo {
        return $this->belongsTo(Parking::class);
    }
    public function parkingslots()
    {
        return $this->hasMany(ParkingSlot::class);
    }
}
