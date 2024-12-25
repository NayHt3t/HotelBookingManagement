<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name']; // Allow mass assignment for 'name'

    public function roomPrices()
{
    return $this->hasMany(RoomPrice::class, 'price_type_id');
}

}
