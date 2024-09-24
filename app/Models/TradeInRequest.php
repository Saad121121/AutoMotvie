<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeInRequest extends Model
{
    use HasFactory;
    protected $table = 'trade_in_requests';
    protected $fillable = [
        'full_name',
        'email_address',
        'phone_number',
        'street_address',
        'city',
        'state',
        'zip_code',
        'make',
        'model',
        'year',
        'mileage',
        'vin',
        'condition',
        'color',
        'current_market_value',
        'additional_comments',
        'preferred_contact_method',
        'trade_in_timing',
        'preferred_dealership_location',
        'car_photos',
    ];

    protected $casts = [
        'car_photos' => 'array',
    ];
}
