<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    const ACTIVE = true;
    const INACTIVE = false;

    use HasFactory;

    protected $fillable = [
        "name",
        "event_id"
    ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function name(){
       return $this->name;
    }

    public function theCheck(){
        return $this->the_check;
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function member()
    {
        return $this->hasMany(Member::class);
    }
}
