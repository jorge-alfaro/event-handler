<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "event_id",
    ];

    protected $casts = [
        'payment_status' => 'array',
        'a_piece' => 'boolean',
        'paid' => 'boolean'
    ];

    protected $attributes = [
        'payment_status' => '{"a_piece": false,"paid": false }'
    ];

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
