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
        'tour_code',
        'name',
        'category_id',
        'description',
        'slug',
        'is_active',
    ];
    protected $guarded = ['id'];

    public function versions()
    {
        return $this->hasMany(TourVersion::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
