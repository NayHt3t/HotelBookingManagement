<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'facilities', 'num_rooms', 'num_people', 'extrabed_status', 'status','featured_image', 'gallery'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function roomPrices()
{
    return $this->hasMany(RoomPrice::class, 'room_type_id');
}

}
