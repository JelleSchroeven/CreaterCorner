<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'banner_image',
    ];

    public function owner()
    {
        return $this->belongsTo(user::class, 'user_is');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'user_id', 'user_id');
    }
}
