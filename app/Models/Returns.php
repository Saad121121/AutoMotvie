<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;
    protected $fillable = ['part_id', 'showroom_id', 'return_date', 'reason', 'quantity', 'status'];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function showroom()
    {
        return $this->belongsTo(Showroom::class);
    }

    public function actions()
    {
        return $this->hasMany(ReturnAction::class);
    }
}
