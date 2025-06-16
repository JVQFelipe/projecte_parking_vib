<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['plate', 'entryTime', 'exitTime', 'isPaid','totaltime','totalPay', 'parking_id', 'parkingslot_id'];


    public function parking(): BelongsTo {
        return $this->belongsTo(Parking::class);
    }
}
