<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'sales';

    // The attributes that are mass assignable.
    protected $fillable = [
        'customer_id', //string
        'invoice_number', //string
        'full_name',
        'contact_info',
        'driver_license',
        'customer_type',
        'make',
        'model',
        'year',
        'vin',
        'color',
        'mileage',
        'condition',
        'additional_features',
        'sales_date',
        'sales_person_name',
        'payment_method',
        'financing_details',
        'trade_in_details',
        'discounts_offers',
        'total_price',
        'warranty_type',
        'warranty_duration',
        'service_plan',
        'scheduled_delivery_date',
        'documents_required',
        'signed_contract',
        'regulatory_compliance',
        'delivery_method',
        'delivery_address',
        'delivery_status',
        'special_instructions',
        'comments',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'sales_date' => 'date',
        'scheduled_delivery_date' => 'date',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [];

    // The attributes that should be mutated to dates.
    protected $dates = [
        'sales_date',
        'scheduled_delivery_date',
    ];
}
