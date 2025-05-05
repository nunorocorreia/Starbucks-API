<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'order',
            'id' => $this->id,
            'attributes' => [
                'price' => $this->price,
                'amount-given' => $this->amount_given,
                'change' => $this->change,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'drink' => [
                    'data' => [
                        'type' => 'drink',
                        'id' => $this->id_drink,
                        'attributes' => [
                            'name' => $this->drinks->name,
                            'price' => $this->drinks->price,
                        ],
                    ],
                    'links' => [
                        'self' => !route('drinks.show', ['drink' => $this->id_drink]),
                    ],
                ],
                'extras' => [
                    'data' => $this->extras->map(function($extra) {
                        return [
                            'type' => 'extras',
                            'id' => $extra->id,
                            'attributes' => [
                                'name' => $extra->name,
                                'price' => $extra->price,
                            ],
                        ];
                    }),
                ],

            ],
        ];
    }
}
