<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
