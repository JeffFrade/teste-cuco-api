<?php

namespace App\Service;

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
     */
    public function index(array $params)
    {
        return $this->getClientRepository()->allNoTrashed();
    }
}
