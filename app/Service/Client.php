<?php

namespace App\Service;

use App\Core\Exceptions\ClientEmptyResultDataException;
use App\Core\Exceptions\ClientNonexistentIdException;
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
}
