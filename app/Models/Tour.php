<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    /** @use HasFactory<\Database\Factories\TourFactory> */
    use HasFactory, SoftDeletes;
    protected $table = 'tours';
    protected $fillable = [
        'name',
        'type',
        'description',
        'slug',
        'is_active',
    ];
    protected $guarded = ['id'];

    public function versions()
    {
        return $this->hasMany(TourVersion::class);
    }
}
