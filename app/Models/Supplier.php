<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    protected $casts = [
        'contact_info' => 'array', // Parse JSON liên hệ thành Array
    ];

    public function services()
    {
        return $this->hasMany(TourService::class);
    }
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'reference');
    }
}
