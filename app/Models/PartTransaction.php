<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['part_id', 'transaction_type', 'quantity', 'transaction_date', 'notes', 'showroom_id'];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function showroom()
    {
        return $this->belongsTo(Showroom::class);
    }
}
