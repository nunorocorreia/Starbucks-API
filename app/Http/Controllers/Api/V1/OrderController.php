<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\V1\OrdersFilter;
use App\Http\Requests\Api\V1\StoreOrderRequest;
use App\Http\Resources\Api\V1\OrderResource;
use App\Models\Drink;
use App\Models\Extras;
use App\Models\Order;
use App\Models\OrderExtras;
use App\Traits\ApiResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(OrdersFilter $filters)
    {
        return OrderResource::collection(Order::filter($filters)->paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            $idDrink = $request->input('data.relationships.drinks.data.id');
            $idExtras = $request->input('data.relationships.extras.data.*.id');
            $drink = Drink::findOrFail($idDrink);
            $extras = Extras::whereIn('id', $idExtras)->get();

            $total = $drink->price + $extras->sum('price');
            if ($total >= $request->input('data.attributes.amount')) {
                return $this->error('The amount is not enough, total: ' . $total, 422);
            }

            $order = Order::create([
                'id_drink' => $idDrink,
                'price' => $total,
                'amount_given' => $request->input('data.attributes.amount'),
                'change' => $request->input('data.attributes.amount') - $total,
            ]);

            foreach ($idExtras as $extraId) {
                OrderExtras::create([
                    'id_order' => $order->id,
                    'id_extra' => $extraId
                ]);
            }
        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), 404);
        }

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $idOrder)
    {
        try {
            $order = Order::findOrFail($idOrder);
            return new OrderResource($order);
        } catch (ModelNotFoundException) {
            return $this->error('Order not found', 404);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
