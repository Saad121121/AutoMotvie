<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'showroom_id',
        'service_date',
        'kilometers_driven',
        'service_type',
        'status',
        'additional_requests',
        'estimated_completion_time',
        'cost_estimate',
        'remarks'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function showroom()
    {
        return $this->belongsTo(Showroom::class, 'showroom_id');
    }
    public function serviceItems()
    {
        return $this->hasMany(ServiceItems::class);
    }
}
