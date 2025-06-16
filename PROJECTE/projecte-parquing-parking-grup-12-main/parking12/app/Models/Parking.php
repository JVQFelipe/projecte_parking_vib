<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'city', 'latitude', 'longitude', 'openTime', 
        'closingTime', 'parkingType', 'isOpen', 'availableSlots'
    ];

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

    public function tickets()
{
    return $this->hasMany(Ticket::class);
}

public function manager()
{
    return $this->hasOne(User::class);  // Un parking té 1 sol manager
}

public function rates()
{
    return $this->belongsToMany(Rate::class, 'parking_rates', 'parking_id', 'rate_id');
}

public function images()
{
    return $this->hasMany(Img::class);
}
public function reports()
    {
        return $this->hasMany(Report::class);
    }

}
