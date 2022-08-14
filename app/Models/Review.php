<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'rating',
        'description',
        'product_id',
        'user_id',
        'name',
    ];

    protected $hidden = [
        'accepted'
    ];
}
