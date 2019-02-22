<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ExceptionBadRequest;
use App\Exceptions\ExceptionNotFound;
use App\Http\Controllers\Controller;
use App\Models\ClientAuth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grant_type' => 'required|in:client_credentials',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ExceptionBadRequest;
        }

        $clientAuth = new ClientAuth();

        $clientId = $request->input('client_id');
        $clientSecret = $request->input('client_secret');
        if ($clientAuth->authorize($clientId, $clientSecret)) {
            $token = $clientAuth->generateToken($clientId);

            return response()->json([
                'access_token' => $token->token,
                'token_type' => 'bearer',
                'expired_in' => Carbon::now()->diffInMinutes($token->expired_at)
            ]);
        }


        throw new ExceptionBadRequest;
    }


}

