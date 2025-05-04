<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExtras extends Model
{
    /** @use HasFactory<\Database\Factories\OrderExtrasFactory> */
    use HasFactory;

    protected $table = 'order_extras';
    protected $fillable = [
        'id_order',
        'id_extra'
    ];
}
