<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    
           /**
     * @OA\Post(
     *     path="/api/payment/create-payment-intent/order/{orderId}",
     *     summary="Create a Stripe PaymentIntent and local payment record",
     *     tags={"Payments"},
     *
     *     @OA\Parameter(
     *         name="orderId",
     *         in="path",
     *         required=true,
     *         description="ID of the order linked to this payment",
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount","paymentMethod"},
     *             @OA\Property(property="amount", type="number", example=25.50),
     *             @OA\Property(property="paymentMethod", type="string", example="card")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="PaymentIntent created",
     *         @OA\JsonContent(
     *             @OA\Property(property="clientSecret", type="string", example="pi_12345_secret_abc"),
     *             @OA\Property(
     *                 property="payment",
     *                 type="object",
     *                 example={
     *                      "id": 10,
     *                      "amount": 25.50,
     *                      "paymentMethod": "card",
     *                      "transactionId": null,
     *                      "status": "PENDING"
     *                 }
     *             )
     *         )
     *     )
     * )
     */


    public function createPaymentIntentWithCardd(Request $request,$orderId){

        $data=$request->validate([
            "amount"=>"required",
            "paymentMethod"=>"required"
            
        ]);
         // 1. Create payment record
    $payment = Payment::create([
        "amount" => $data["amount"],
        "paymentMethod" => $data["paymentMethod"],
        "transactionId" => null,
        
    ]);

    // 2. Stripe secret key
    Stripe::setApiKey(env("STRIPE_SECRET"));

    // Convert USD → cents
    $stripeAmount = intval($payment->amount * 100);

    // 3. Stripe PaymentIntent creation
    $paymentIntent = PaymentIntent::create([
        "amount" => $stripeAmount,
        "currency" => "usd",
        "metadata" => [
            
            "payment_id" => $payment->id
        ],
      
    ]);

   
    return response()->json([
        "clientSecret" => $paymentIntent->client_secret,
        "payment" => $payment
    ]);
      
    }


     /**
     * @OA\Post(
     *     path="/api/payment/registerPayment",
     *     summary="Register the transaction id of a payment",
     *     tags={"Payments"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"paymentId","transactionId"},
     *             @OA\Property(property="paymentId", type="integer", example=10),
     *             @OA\Property(property="transactionId", type="string", example="pi_3Xx123abc")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Payment completed successfully",
     *         @OA\JsonContent(type="string", example="Payment completed")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Payment not found",
     *         @OA\JsonContent(type="string", example="Payment does not exists")
     *     )
     * )
     */
    public function storePayment(Request $request)
    {

        $data=$request->validate(
           [ "transactionId"=>"required",
            "paymentId"=>"required"
            
           ]
          
        );
         
        $payment=Payment::find($data["paymentId"]);
       
        if($payment!=null){
            $payment->transactionId=$data["transactionId"];
            $payment->status=PaymentStatus::COMPLETED->value;
            $payment->save();

        return response("Payment completed",201);
        }

        return response("Payment does not exists",404
    );
        
       
    }

   
}
