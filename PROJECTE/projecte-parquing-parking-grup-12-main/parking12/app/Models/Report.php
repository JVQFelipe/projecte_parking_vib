<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'created_at', 'updated_at', 'parking_id',
    ]; 
  
    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }
}
