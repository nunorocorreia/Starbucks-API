<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\V1\DrinksFilter;
use App\Http\Resources\Api\V1\DrinkResource;
use App\Models\Drink;
use App\Traits\ApiResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Ticket;

class DrinkController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(DrinksFilter $filters)
    {
        return DrinkResource::collection(Drink::filter($filters)->paginate());
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $idDrink)
    {
        try {
            $drink = Drink::findOrFail($idDrink);
            return new DrinkResource($drink);
        } catch (ModelNotFoundException) {
            return $this->error('Drink not found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drink $drink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Drink $drink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drink $drink)
    {
        //
    }
}
