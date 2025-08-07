<?php

namespace App\Services;

class RedisCoasters
{
    private array $data;

    private RedisClient $redisClient;

    public function __construct()
    {
        $this->redisClient = service('redisclient');
        $this->load();
    }

    public function saveCoaster(array $data): int
    {
        if (!isset($data['id'])) {
            $data['id'] = count($this->data);
        }
        $this->data[$data['id']] = $data;
        $this->save();

        return $data['id'];
    }

    private function load()
    {
        $this->data = $this->redisClient->loadData();
    }

    private function save()
    {
        $this->redisClient->saveData($this->data);
    }
}
