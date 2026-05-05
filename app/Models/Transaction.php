<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    // Quan hệ đa hình: Có thể thuộc về Booking (Thu) hoặc Supplier (Chi)
    public function reference()
    {
        return $this->morphTo();
    }

    public function schedule()
    {
        return $this->belongsTo(TourSchedule::class);
    }
}
