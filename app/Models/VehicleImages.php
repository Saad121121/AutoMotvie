<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImages extends Model
{
    protected $fillable = [
        'vehicle_id',
        'image_path',
    ];
    protected $table = 'vehicle_images';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    use HasFactory;
}
