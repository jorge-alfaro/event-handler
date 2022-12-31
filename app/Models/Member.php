<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "events_id"
    ];

    protected $casts = [
        'payment_status' => 'array'
    ];

    protected $attributes = [
        'payment_status' => '{
            "abonado": false,
            "pagado": false
        }'
    ];
}
