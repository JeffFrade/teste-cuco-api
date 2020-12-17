<?php

namespace App\Service;

use App\Core\Exceptions\ClientEmptyResultDataException;
use App\Core\Exceptions\ClientInvalidArgumentException;
use App\Core\Exceptions\ClientNonexistentIdException;
use App\Helpers\DateHelper;
use App\Helpers\StringHelper;
use App\Repositories\ClientRepository;

class Client
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @param ClientRepository $clientRepository
     */
    public function setClientRepository(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @return ClientRepository
     */
    public function getClientRepository()
    {
        return $this->clientRepository ?? $this->createDefaultClientRepository();
    }

    /**
     * @return ClientRepository
     */
    private function createDefaultClientRepository()
    {
        return new ClientRepository();
    }

    /**
     * @param array $params
     * @return mixed
     * @throws ClientEmptyResultDataException
     */
    public function index(array $params = [])
    {
        $name = $params['name'] ?? '';
        $document = StringHelper::formatDocument($params['document'] ?? '');

        $data = $this->getClientRepository()->getClients($name, $document);

        $this->verifyIfResultDataIsEmpty($data);

        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function store(array $params)
    {
        $params['document'] = StringHelper::formatDocument($params['document'] ?? '');
        $params['phone'] = StringHelper::formatPhone($params['phone' ?? '']);
        $params['birth_date'] = DateHelper::formatDate($params['birth_date'] ?? '');

        return $this->getClientRepository()->create($params);
    }

    /**
     * @param int $id
     * @throws ClientNonexistentIdException
     */
    public function delete(int $id)
    {
        $this->verifyIfExistsClient($id);
        $this->getClientRepository()->delete($id);
    }

    /**
     * @param $data
     * @throws ClientEmptyResultDataException
     */
    private function verifyIfResultDataIsEmpty($data)
    {
        if (count($data) <= 0) {
            throw new ClientEmptyResultDataException('A Pesquisa Não Obteve Nenhum Resultado');
        }
    }

    /**
     * @param int $id
     * @throws ClientNonexistentIdException
     */
    private function verifyIfExistsClient(int $id)
    {
        if ($this->getClientRepository()->exists($id) <= 0) {
            throw new ClientNonexistentIdException($id);
        }
    }

    /**
     * @param array $validation
     * @throws ClientInvalidArgumentException
     */
    public function verifyIfEmptyParamsOnValidation(array $validation)
    {
        if (empty($validation) === true) {
            throw new ClientInvalidArgumentException(trans('exceptions.empty-params'));
        }
    }

    /**
     * @param array $validation
     * @throws ClientInvalidArgumentException
     */
    public function verifyErrorMessageOnValidation(array $validation)
    {
        if (empty($validation['error']) === false) {
            throw new ClientInvalidArgumentException($validation['error']);
        }
    }
}
