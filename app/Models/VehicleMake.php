<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMake extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_of_origin', 'year_established', 'vehicle_type'];

    public function models()
    {
        return $this->hasMany(VehicleModel::class, 'make_id');
    }
}
