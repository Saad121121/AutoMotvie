<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItems extends Model
{
    use HasFactory;
    protected $table = 'service_items';
    protected $fillable = [
        'service_id',
        'item',
    ];

    // Define the inverse relationship with the Service model
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
