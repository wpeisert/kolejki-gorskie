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
        if (!isset($this->data[$idCoaster])) {
            throw new \Exception('Non existent coaster ID: ' . $idCoaster);
        }

        $this->data[$idCoaster] = array_merge($this->data[$idCoaster], $data);
        $this->saveData();
    }

    public function createWagon(int $idCoaster, array $data): int
    {
        $this->loadData();

        if (!isset($this->data[$idCoaster])) {
            throw new \Exception('Non existent coaster ID: ' . $idCoaster);
        }

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

        if (!isset($this->data[$idCoaster])) {
            throw new \Exception('Non existent coaster ID: ' . $idCoaster);
        }

        $wagonsOld = $this->data[$idCoaster]['wagons'] ?? [];
        $wagons = array_filter(
            $wagonsOld,
            function ($wagon) use ($idWagon) {
                return $wagon['idWagon'] != $idWagon;
            }
        );
        $wagons = array_values($wagons);
        if (count($wagonsOld) === count($wagons)) {
            throw new \Exception('Non existent wagon ID: ' . $idWagon . ' for coaster ID: ' . $idCoaster);
        }
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
