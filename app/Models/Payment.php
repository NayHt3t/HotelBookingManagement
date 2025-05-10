<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'booking_id',
        'payment_type_id',
        'amount',
        'status'
    ];

     // Relationship: A payment belongs to a payment type
     public function paymentType()
     {
         return $this->belongsTo(PaymentType::class);
     }

      // Relationship: A payment might belong to a booking
    public function booking()
    {
        return $this->belongsTo(Booking::class); // Assuming you have a Booking model
    }
    
}
