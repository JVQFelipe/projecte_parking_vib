<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParkingSlot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slotType', 'slotStatus', 'x1', 'y1', 'x2', 'y2','assignedPlate'];
    protected $table = 'parkingslots'; // test seeders (it works!)

    public function floor(): BelongsTo {
        return $this->belongsTo(Floor::class);
    }
    
}
