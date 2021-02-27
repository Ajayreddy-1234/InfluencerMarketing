<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'service_id',
        'inf_id',
        'count_x',
    ];
}
