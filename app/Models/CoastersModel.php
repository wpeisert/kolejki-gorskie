<?php

namespace App\Models;

use App\Services\RedisCoasters;

class CoastersModel
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function save()
    {
        /** @var RedisCoasters $redisCoasters */
        $redis = service('redisCoasters');
        $this->data['idCoaster'] = $redis->saveCoaster($this->data);
        return $this->data['idCoaster'];
    }

    public function getIdCoaster(): ?int
    {
        return $this->data['idCoaster'];
    }
}
