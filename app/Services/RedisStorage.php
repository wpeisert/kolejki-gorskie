<?php

namespace App\Services;

class RedisStorage
{
    private array $data;

    private RedisClient $redisClient;

    public function __construct()
    {
        $this->redisClient = service('redisClient');
        $this->data = [];
    }

    public function createCoaster(array $data): int
    {
        $this->loadData();
        $idCoaster = count($this->data);
        $data['idCoaster'] = $idCoaster;
        $this->data[$idCoaster] = $data;
        $this->saveData();

        return $idCoaster;
    }

    public function updateCoaster(int $idCoaster, array $data): void
    {
        $this->loadData();
        $this->data[$idCoaster] = array_merge($this->data[$idCoaster], $data);
        $this->saveData();
    }

    public function createWagon(array $data): int
    {

    }

    public function deleteWagon(int $idCoaster, int $idWagon)
    {

    }

    private function loadData()
    {
        $this->data = $this->redisClient->loadData();
    }

    private function saveData()
    {
        $this->redisClient->saveData($this->data);
    }
}
