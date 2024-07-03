<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function show(string $dni)
    {
        $client = Client::where('dni', $dni)->first();
        if($client == null){
            return response()->json([
                'message' => 'Cliente no encontrado'
            ],201);
        }else{
            return response()->json([
                'message'=>'Cliente encontrado',
                'data'=>[
                    'id' => $client->id,
                    'name' => $client->name,
                    'dni' => $client->dni,
                    'email' => $client->email,
                    'phone' => $client->phone,
                ],
            ],201);
        }
        
    }
}
