<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vin',
        'make_id',
        'model_id',
        'year_of_manufacture',
        'color',
        'engine_type',
        'mileage',
        'registration_number',
        'owner_id',
        'showroom_id',
    ];

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'make_id');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


    public function showroom()
    {
        return $this->belongsTo(Showroom::class, 'showroom_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function images()
    {
        return $this->hasMany(VehicleImages::class);
    }
    public function accident()
    {
        return $this->hasMany(Accident::class);
    }
    public function accidentImages()
    {
        return $this->hasMany(AccidentImage::class);
    }
}
