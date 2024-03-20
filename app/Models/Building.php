<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'image',
        'lowest_price',
        'highest_price',
        'description',
        'land_area',
        'building_area',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
