<?php

namespace App\Services;

class RedisCoasters
{
    private array $data;

    private RedisClient $redisClient;

    public function __construct()
    {
        $this->redisClient = service('redisclient');
        $this->data = $this->redisClient->loadData();
    }

    public function saveCoaster(array $data): int
    {
        if (!isset($data['idCoaster'])) {
            $data['idCoaster'] = count($this->data);
            $this->data[$data['idCoaster']] = $data;
        } else {
            $this->data[$data['idCoaster']] = array_merge($this->data[$data['idCoaster']], $data);
        }

        $this->redisClient->saveData($this->data);

        return $data['idCoaster'];
    }
}
