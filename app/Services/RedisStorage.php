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

    public function createWagon(int $idCoaster, array $data): int
    {
        $this->loadData();

        $wagons = $this->data[$idCoaster]['wagons'] ?? [];
        $maxId = -1;
        foreach ($wagons as $wagon) {
            $maxId = max($maxId, $wagon['idWagon']);
        }
        $idWagon = $maxId + 1;
        $data['idWagon'] = $idWagon;
        $wagons[] = $data;
        $this->data[$idCoaster]['wagons'] = $wagons;

        $this->saveData();

        return $idWagon;
    }

    public function deleteWagon(int $idCoaster, int $idWagon)
    {
        $this->loadData();

        $wagons = $this->data[$idCoaster]['wagons'] ?? [];
        $wagons = array_filter(
            $wagons,
            function ($wagon) use ($idWagon) {
                return $wagon['idWagon'] != $idWagon;
            }
        );
        $wagons = array_values($wagons);
        $this->data[$idCoaster]['wagons'] = $wagons;

        $this->saveData();
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
