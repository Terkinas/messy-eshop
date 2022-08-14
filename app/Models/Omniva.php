<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Omniva extends Model
{
    use HasFactory;

    protected $table = 'omniva';

    protected $fillable = [
        'order_id',
        'name',
        'xcordinate',
        'ycordinate',
        'terminalId',
        'city',
        'street',
        'comment'
    ];

    protected $hidden = [];
}
