<?php

namespace App\Http\Filters\Api\V1;

class OrdersFilter extends QueryFilter
{
    protected $sortable = [
        'id_drink',
        'price',
        'amount_given',
        'change',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];

    public function price($value)
    {
        return $this->builder->where('price', $value);
    }

    public function createdAt($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }
}
