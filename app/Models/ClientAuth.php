<?php

namespace App\Models;

use App\Exceptions\ExceptionNotFound;
use App\Exceptions\ExceptionUnauthorized;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ClientAuth
{

    public function authorize($clientId, $secret)
    {
        try {
//            $client = Clients::query()
//                ->where('client_id', $clientId)
//                ->firstOrFail();
            $clients = Clients::all();
            foreach ($clients as $client) {
//                print_r($client->getAttributes());
            }

        } catch (\Exception $e) {
            throw new ExceptionNotFound;
        }

        if (!Hash::check($secret, $client->getAttribute('password'))) {
            throw new ExceptionUnauthorized;
        }
        return !empty($client);
    }

    public function generateToken($clientId)
    {
        do {
            $token = sha1($clientId . time() . rand());
        } while (ClientToken::where('token', $token)->count());

        $clientToken = new ClientToken();
        $clientToken->fill([
            'client_id' => $clientId,
            'token' => $token,
            'expired_at' => Carbon::now()->addMinutes(60)
        ]);
        $clientToken->save();

        return $clientToken;
    }
}
