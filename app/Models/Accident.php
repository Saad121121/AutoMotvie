<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    protected $table = 'accidents';
    protected $fillable = ['vehicle_id', 'description', 'accident_date'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function images()
    {
        return $this->hasMany(AccidentImage::class);
    }
    use HasFactory;
}
