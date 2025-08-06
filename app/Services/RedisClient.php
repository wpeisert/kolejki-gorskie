<?php

namespace App\Services;

use Predis\Client;

class RedisClient extends Client
{
    private const KEY = "kolejki";

    public function __construct()
    {
        parent::__construct(
            [
                'scheme'   => 'tcp',
                'host'     => 'redis',
                'port'     => 6379,
                'password' => '',
                'database' => 0,
            ]
        );
    }

    public function loadData(): array
    {
        $data = $this->get(self::KEY);
        $json = json_decode($data, true);
        return $json ?? [];
    }

    public function saveData(array $data)
    {
        $str = json_encode($data);
        $this->set(self::KEY, $str);
    }
}
