<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "price",
        "event_id"
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];
}
