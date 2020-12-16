<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Client;

class ClientRepository extends AbstractRepository
{
    /**
     * ClientRepository constructor.
     */
    public function __construct()
    {
        $this->model = $this->getClient();
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->model ?? $this->createDefaultClient();
    }

    /**
     * @return Client
     */
    private function createDefaultClient()
    {
        return new Client();
    }
}
