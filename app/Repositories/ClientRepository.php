<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Helpers\StringHelper;
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

    /**
     * @param string $name
     * @param string $document
     * @return mixed
     */
    public function getClients(string $name = '', string $document = '')
    {
        $model = $this->model;

        if (!empty($name)) {
            $model = $model->where('name', 'like', StringHelper::mountLikeCriteria($name));
        }

        if (!empty($document)) {
            $model = $model->where('document', 'like', StringHelper::mountLikeCriteria($document));
        }

        return $model->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function exists(int $id)
    {
        return $this->model->where('id', $id)->count();
    }
}
