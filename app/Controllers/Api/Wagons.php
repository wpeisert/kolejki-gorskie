<?php

namespace App\Controllers\Api;

use App\Services\RedisStorage;
use CodeIgniter\RESTful\ResourceController;

class Wagons extends ResourceController
{
    public function create(?int $idCoaster = null)
    {
        $data = $this->getBodyData();
        /** @var RedisStorage $redisStorage */
        $redisStorage = service('redisStorage');
        $idWagon = $redisStorage->createWagon($idCoaster, $data);

        return 'Created wagon ID: ' . $idWagon . ' for coaster ID: ' . $idCoaster;
    }

    public function delete($idCoaster = null, $idWagon = null)
    {
        /** @var RedisStorage $redisStorage */
        $redisStorage = service('redisStorage');
        $redisStorage->deleteWagon($idCoaster, $idWagon);

        return 'Deleted wagon ID: ' . $idWagon . ' for coaster ID: ' . $idCoaster;
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
