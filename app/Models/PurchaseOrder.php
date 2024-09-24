<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = ['po', 'showroom_id', 'order_date', 'status', 'total_amount', 'received_quantity'];


    public function showroom()
    {
        return $this->belongsTo(Showroom::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
