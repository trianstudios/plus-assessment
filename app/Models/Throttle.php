<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Throttle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'ip_location',
        'login_at',
        'user_agent',
    ];
}
