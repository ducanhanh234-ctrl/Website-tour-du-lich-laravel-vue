<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    protected $table = 'tour_images';
    protected $fillable = ['tour_version_id', 'image_url', 'is_main'];
    protected $guarded = ['id'];

    public function tourVersion()
    {
        return $this->belongsTo(TourVersion::class);
    }
}
