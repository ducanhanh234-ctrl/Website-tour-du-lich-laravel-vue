<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourVersion extends Model
{
    /** @use HasFactory<\Database\Factories\TourVersionFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $casts = [
        'policies' => 'array', // Tự động parse JSON sang Array cho Vue
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    public function itineraries()
    {
        return $this->hasMany(TourItinerary::class);
    }
    public function schedules()
    {
        return $this->hasMany(TourSchedule::class);
    }
    public function images()
    {
        return $this->hasMany(TourImage::class);
    }
}
