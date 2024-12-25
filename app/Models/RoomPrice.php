<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'room_price'; // Specify the table name if it doesn't follow Laravel's plural naming convention
    protected $fillable = ['room_type_id', 'price_type_id', 'price'];

    // Relationships
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function priceType()
    {
        return $this->belongsTo(Pricetype::class, 'price_type_id');
    }

    public function promotions()
{
    return $this->hasMany(Promotion::class, 'room_price_id');
}
}
