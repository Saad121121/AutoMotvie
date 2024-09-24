<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SellMyCar extends Model
{
    use HasFactory;
    public function sellmycar()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $table = 'sell_my_cars';
    protected $fillable = [
    
      
        'car_Info',
        'color',
        'mileage',
        'price',
        'add_description',
        // 'product_image',
    ];
}
