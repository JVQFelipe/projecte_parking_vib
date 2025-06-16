<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Img extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'parking_id'];

    public function parking(): BelongsTo {
        return $this->belongsTo(Parking::class);
    }
}
