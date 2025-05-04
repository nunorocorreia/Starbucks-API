<?php

namespace App\Models;

use App\Http\Filters\Api\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Drink extends Model
{
    /** @use HasFactory<\Database\Factories\DrinkFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'id_category',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }
}
