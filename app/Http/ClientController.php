<?php

namespace App\Http;

use App\Core\Exceptions\ClientEmptyResultDataException;
use App\Core\Exceptions\ClientInvalidArgumentException;
use App\Core\Exceptions\ClientNonexistentIdException;
use App\Core\Support\Controller;
use App\Service\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        try {
            $params = $this->toValidate($request);
            $data = $this->client->store($params);

            return $this->successResponse($data);
        } catch (ClientInvalidArgumentException $e) {
            return $this->errorResponse($e->getMessage(), 0, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $this->client->delete($id);

            return $this->successResponse(sprintf(trans('exceptions.client-success-delete'), $id));
        } catch (ClientNonexistentIdException $e) {
            return $this->errorResponse($e->getMessage(), 0, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws ClientInvalidArgumentException
     * @throws ValidationException
     */
    private function toValidate(Request $request)
    {
        $validation = $this->validate($request, [
            'name' => 'required|max:150',
            'document' => 'required|max:14',
            'birth_date' => 'required|max:10',
            'phone' => 'nullable|max:15',
        ]);

        $this->client->verifyIfEmptyParamsOnValidation($validation);
        $this->client->verifyErrorMessageOnValidation($validation);

        return $validation;
    }


}
