<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public function parkings()
{
    return $this->belongsToMany(Parking::class, 'parking_rates');
}

}
