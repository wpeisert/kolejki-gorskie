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
        if (!isset($data['id'])) {
            $data['id'] = count($this->data);
            $this->data[$data['id']] = $data;
        } else {
            $this->data[$data['id']] = array_merge($this->data[$data['id']], $data);
        }

        $this->redisClient->saveData($this->data);

        return $data['id'];
    }
}
