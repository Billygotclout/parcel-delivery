<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRide extends Model
{
    use HasFactory;

    protected $fillable =
     [
         'user_id',
         'current_location',
         'destination',
         'price_of_ride',
         'parcel_delivery_type'
     ];
}
