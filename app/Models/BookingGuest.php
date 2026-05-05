<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingGuest extends Model
{
    /** @use HasFactory<\Database\Factories\BookingGuestFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
