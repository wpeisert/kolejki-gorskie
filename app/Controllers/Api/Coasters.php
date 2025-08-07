<?php

namespace App\Controllers\Api;

use App\Services\RedisStorage;
use CodeIgniter\RESTful\ResourceController;

class Coasters extends ResourceController
{
    public function create()
    {
        $data = $this->getBodyData();
        /** @var RedisStorage $redisStorage */
        $redisStorage = service('redisStorage');
        $idCoaster = $redisStorage->createCoaster($data);

        return 'Created coaster ID: ' . $idCoaster;
    }

    public function update($idCoaster = null)
    {
        $data = $this->getBodyData();

        /** @var RedisStorage $redisStorage */
        $redisStorage = service('redisStorage');
        $redisStorage->updateCoaster($idCoaster, $data);

        return 'Updated coaster ID: ' . $idCoaster;
    }

    private function getBodyData(): array
    {
        $body = $this->request->getBody();
        $data = json_decode($body, true);
        if (json_last_error()) {
            throw new \Exception();
        }

        return $data;
    }
}
