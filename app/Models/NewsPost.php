<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image_path', 'publication_date','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
