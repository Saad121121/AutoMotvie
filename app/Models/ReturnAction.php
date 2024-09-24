<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnAction extends Model
{
    use HasFactory;
    protected $fillable = ['return_id', 'action_taken', 'action_date'];

    public function returns()
    {
        return $this->belongsTo(Returns::class);
    }
}
