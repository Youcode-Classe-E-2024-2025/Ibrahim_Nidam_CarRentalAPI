<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Exception;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * @OA\Post(
     *     path="/rentals",
     *     summary="Create a rental and initiate payment",
     *     tags={"Rentals"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"car_id","start_date","return_date"},
     *             @OA\Property(property="car_id", type="integer", example=1),
     *             @OA\Property(property="start_date", type="string", format="date", example="2025-03-15"),
     *             @OA\Property(property="return_date", type="string", format="date", example="2025-03-20")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Checkout session URL",
     *         @OA\JsonContent(
     *             @OA\Property(property="checkout_url", type="string", example="https://checkout.stripe.com/pay/cs_test_...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id'      => 'required|exists:cars,id',
            'start_date'  => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);
        $dailyRate = 150.8; // fixed rate, update as needed
        $startDate = Carbon::parse($request->start_date);
        $returnDate = Carbon::parse($request->return_date);
        $days = $startDate->diffInDays($returnDate) + 1;
        $amount = $dailyRate * $days;

        $rental = Rental::create([
            'user_id'     => Auth::id() ?? 1,
            'car_id'      => $request->car_id,
            'start_date'  => $request->start_date,
            'return_date' => $request->return_date,
            'amount'      => $amount,
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name'        => 'Car Rental',
                            'description' => 'Rental for ' . $car->make . ' ' . $car->model,
                        ],
                        'unit_amount' => $amount * 100, // Stripe uses cents
                    ],
                    'quantity' => 1,
                ]],
                'mode'         => 'payment',
                'success_url'  => route('rentals.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
                'cancel_url'   => route('rentals.cancel'),
                'metadata'     => [
                    'rental_id' => $rental->id,
                ],
            ]);

            Payment::create([
                'rental_id' => $rental->id,
                'amount'    => $amount,
            ]);

            return response()->json([
                'checkout_url' => $session->url,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return response()->json(['error' => 'Missing session id'], 400);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if ($session->payment_status !== 'paid') {
                return response()->json(['error' => 'Payment not completed'], 400);
            }
            $rentalId = $session->metadata->rental_id;

            return response()->json(['message' => 'Payment successful!']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cancel()
    {
        return response()->json(['message' => 'Payment canceled']);
    }
}
