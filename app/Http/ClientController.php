<?php

namespace App\Http;

use App\Core\Exceptions\ClientEmptyResultDataException;
use App\Core\Support\Controller;
use App\Service\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        try {
            $data = $this->client->index($request->all() ?? []);

            return $this->successResponse($data);
        } catch (ClientEmptyResultDataException $e) {
            return $this->errorResponse($e->getMessage(), 0, Response::HTTP_NOT_FOUND);
        }
    }

    public function delete(int $id)
    {

    }
}
