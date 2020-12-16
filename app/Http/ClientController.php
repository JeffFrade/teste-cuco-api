<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Service\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ClientController constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
         $data = $this->client->index($request->all() ?? []);
         $response = [
             'code' => 1,
             'data' => $data
         ];

         return response()->json($response);
    }
}
