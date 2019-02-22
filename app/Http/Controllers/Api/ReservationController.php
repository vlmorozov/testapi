<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ExceptionBadRequest;
use App\Exceptions\ExceptionUnauthorized;
use App\Models\Clients;
use App\Models\ClientToken;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'data' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ExceptionBadRequest;
        }

        try {
            $data = \GuzzleHttp\json_decode($request->input('data'), true);

            $allProductsInStock = true;
            $stock = [];
            foreach ($data as $product) {
                $productValidator = Validator::make($product, [
                    'product_id' => 'required|int|min:0',
                    'quantity' => 'required|int|min:0'
                ]);

                if ($productValidator->fails()) {
                    throw new ExceptionBadRequest;
                }


                $productInStock = Products::where('id', $product['product_id'])->first();

                if ($productInStock) {
                    if ($productInStock->quantity < intval($product['quantity'])) {
                        $allProductsInStock = false;
                    }
                    $stock[] = [
                        'product_id' => $productInStock->id,
                        'insctock_size' => $productInStock->quantity
                    ];
                }
            }


            if ($allProductsInStock) {
                return response()->json([
                    'reservation_id' => time(),
                    'stock' => $stock
                ]);
            } else {
                return response()->json([
                    'code' => 400,
                    'message' => 'Bad request',
                    'stock' => $stock
                ], 400);
            }
        } catch (\Exception $e) {
        }

        throw new ExceptionBadRequest;
    }


}
