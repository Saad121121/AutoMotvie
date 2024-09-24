<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;
    const UPDATED_AT = null;

    protected $fillable = ['user_id', 'action'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function showroom()
    {
        return $this->belongsTo(Showroom::class);
    }
}
