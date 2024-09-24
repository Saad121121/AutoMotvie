<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellmycars extends Model
{
    use HasFactory;
    protected $table = 'sell_my_cars';
    protected $fillable = [
        'City',
        'City_Area',
        'Car_Info',
        'Color',
        'Mileage',
        'Price',
        'Add_Description',
        'Product_Image',
    ];

    
}
