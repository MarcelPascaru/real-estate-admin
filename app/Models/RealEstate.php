<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'description',
        'cover',
        'phone_number',
        'category',
        'price',
        'location',
        'lat',
        'lng',
    ];
}
