<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Car",
 *     required={"make", "model", "year"},
 *     @OA\Property(property="id", type="integer", format="int64", description="Car ID"),
 *     @OA\Property(property="make", type="string", description="Make of the car"),
 *     @OA\Property(property="model", type="string", description="Model of the car"),
 *     @OA\Property(property="year", type="integer", description="Year of the car"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Timestamp when the car was created"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Timestamp when the car was last updated")
 * )
 */
class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/cars",
     *     tags={"Cars"},
     *     summary="Get a list of cars",
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of cars per page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=5
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of cars",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Car"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);
        
        $cars = Car::paginate($perPage, ['*'], 'page', $page);
        return response()->json($cars);
    }

    /**
     * @OA\Post(
     *     path="/cars",
     *     tags={"Cars"},
     *     summary="Create a new car",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"make","model","year"},
     *             @OA\Property(property="make", type="string"),
     *             @OA\Property(property="model", type="string"),
     *             @OA\Property(property="year", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Car created successfully"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'make'          => 'required|string',
            'model'         => 'required|string',
            'year'          => 'required|integer',
        ]);

        $car = Car::create($request->all());
        return response()->json($car, 201);
    }

    /**
     * @OA\Get(
     *     path="/cars/{id}",
     *     tags={"Cars"},
     *     summary="Get a specific car by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car details",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     )
     * )
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return response()->json($car);
    }

    /**
     * @OA\Put(
     *     path="/cars/{id}",
     *     tags={"Cars"},
     *     summary="Update a car's information",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"make","model","year"},
     *             @OA\Property(property="make", type="string"),
     *             @OA\Property(property="model", type="string"),
     *             @OA\Property(property="year", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car updated successfully"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'make'          => 'sometimes|required|string',
            'model'         => 'sometimes|required|string',
            'year'          => 'sometimes|required|integer',
        ]);

        $car->update($request->all());
        return response()->json($car);
    }

    /**
     * @OA\Delete(
     *     path="/cars/{id}",
     *     tags={"Cars"},
     *     summary="Delete a car",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Car deleted"
     *     )
     * )
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return response()->json(null, 204);
    }
}