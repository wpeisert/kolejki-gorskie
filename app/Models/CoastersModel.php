<?php

namespace App\Models;

use App\Services\Redis;

class CoastersModel
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function save()
    {
        /** @var Redis $redis */
        $redis = service('redis');
        $this->data['id'] = $redis->saveCoaster($this->data);
        return $this->data['id'];
    }

    public function getId(): ?int
    {
        return $this->data['id'];
    }
}
