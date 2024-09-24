<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'shr_name',
        'shr_location',
        'shr_contact_number',
        'shr_contact_email',
    ];

    public function manager()
    {
        return $this->hasOne(User::class, 'showroom_id')->where('role_id', 2);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'showroom_id');
    }

    public function staff()
    {
        return $this->hasMany(User::class, 'showroom_id')->where('role_id', 3);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'showroom_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'showroom_id');
    }
    public function transactions()
    {
        return $this->hasMany(PartTransaction::class);
    }

    public function returns()
    {
        return $this->hasMany(Returns::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
