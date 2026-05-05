<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourItinerary extends Model
{
    /** @use HasFactory<\Database\Factories\TourItineraryFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $casts = [
        'activities' => 'array',
    ];

    public function tourVersion()
    {
        return $this->belongsTo(TourVersion::class);
    }
}
