<?php

namespace App\Models;

use Database\Factories\OrdersFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    /** @use HasFactory<OrdersFactory> */
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'id_drink',
        'id_extras',
        'price',
        'amount-given',
        'change',
    ];

    public function drinks(): BelongsTo
    {
        return $this->belongsTo(Drink::class, 'id_drink');
    }

    public function extras(): BelongsToMany
    {
        return $this->belongsToMany(Extras::class, 'order_extras', 'id_order', 'id_extra');
    }
}
