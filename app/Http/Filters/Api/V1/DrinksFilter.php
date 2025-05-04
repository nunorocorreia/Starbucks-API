<?php

namespace App\Http\Filters\Api\V1;

class DrinksFilter extends QueryFilter
{
    protected $sortable = [
        'name',
        'price',
        'stock',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];

    public function name($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name', 'like', $likeStr);
    }
}
