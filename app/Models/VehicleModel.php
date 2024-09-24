<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'make_id',
        'year_of_release',
        'fuel_type',
        'transmission_type',
        'body_style',
        'engine_type',
        'engine_capacity',
        'horsepower',
        'torque',
    ];

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'make_id');
    }
}
