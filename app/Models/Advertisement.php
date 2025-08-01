<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'car_model_id',
        'created_by',
        'status',
        'expire_date',
        'views',
        'price',
        'currency_id'
    ];
}
