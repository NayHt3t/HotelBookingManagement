<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['room_price_id', 'discount', 'start_date', 'end_date'];

    // Relationship with RoomPrice
    public function roomPrice()
    {
        return $this->belongsTo(RoomPrice::class, 'room_price_id');
    }

    public function roomType()
    {
        return $this->hasManyThrough(RoomType::class, RoomPrice::class);
    }
}