<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'start_date', 'end_date', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
