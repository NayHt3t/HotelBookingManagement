<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'booking_id', 'nrc_or_passport', 'email', 'phone', 'address', 'city', 'country'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function stays()
{
    return $this->hasMany(Stay::class, 'guest_id');
}

}
