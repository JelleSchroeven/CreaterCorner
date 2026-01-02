<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'image', 'content', 'published_at' , 'user_id', 
    ];

    protected $casts  =[
        'publishedd_at' => 'datetime'
    ]

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')
    }
}
