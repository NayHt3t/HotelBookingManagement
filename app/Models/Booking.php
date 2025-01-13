<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'room_type_id', 'qty', 'check_in', 'check_out', 'adult', 'child', 'status'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
