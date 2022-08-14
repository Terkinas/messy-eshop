<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'urltag',

        'subtitle',
        'description',

        'category',

        'color',
        'size',

        'stock_price',
        'price',
        'price_onsale',
        // 'onsale',


        'quantity',
        // 'quantity_sold',

        'subtag1',
        'subtag2',

        'active',

        'added_by',

        'image_path',
    ];

    protected $hidden = [
        'onsale',

        'quantity_sold',
    ];
}
