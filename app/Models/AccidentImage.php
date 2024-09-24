<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentImage extends Model
{
    use HasFactory;
    protected $table = 'accident_images';
    protected $fillable = ['accident_id', 'vehicle_id', 'image_path'];
    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
