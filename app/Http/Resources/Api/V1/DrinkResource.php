<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrinkResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'drink',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'price' => $this->price,
                'stock' => $this->stock,
            ],
            'relationships' => $this->when(
                $request->routeIs('drinks.*'),
                [
                    'category' => [
                        'data' => [
                            'type' => 'category',
                            'id' => $this->id_category,
                            'name' => $this->category->name,
                        ],
                    ],
                    'links' => [
                        'self' => route('categories.show', ['category' => $this->id_category]),
                    ],
                ],
            ),
            'links' => [
                'self' => route('drinks.show', ['drink' => $this->id]),
            ],
        ];
    }
}
