<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'method'
    ];

      // Relationship: A payment type can have many payments
      public function payments()
      {
          return $this->hasMany(Payment::class);
      }
}
