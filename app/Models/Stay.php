<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stay extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['room_id', 'room_number', 'guest_id', 'start_date', 'days'];

    // Relationship with Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Relationship with Guest
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

}
