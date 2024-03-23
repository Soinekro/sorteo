<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
// use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function test()
    {
        $client = new Client();
        $token = config('api_wpp.api_token');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $token",
        ];
        $phone = config('api_wpp.api_phone');
        $phone_id = config('api_wpp.api_id');
        $api_version = config('api_wpp.api_version');
        $body = '{
                    "messaging_product": "whatsapp",
                    "to": "'.$phone.'",
                    "type": "template",
                    "template": {
                        "name": "prueba",
                        "language": {
                        "code": "es"
                        }
                    }
                    }';
        $request = new Psr7Request('POST', "https://graph.facebook.com/$api_version/$phone_id/messages", $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();
    }
}
