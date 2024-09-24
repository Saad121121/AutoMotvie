<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    // Specify the table associated with the model
    protected $table = 'accessories';

    // Define the fillable attributes
    protected $fillable = [
        'showroom_id',
        'name',
        'description',
        'price',
    ];

    // Optionally, if you want to define relationships:
    // Define a relationship with the Showroom model (assuming a Showroom model exists)
    public function showroom()
    {
        return $this->belongsTo(Showroom::class);
    }
}
