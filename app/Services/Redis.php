<?php

namespace App\Services;

class Redis
{
    private const KEY = "kolejki";

    private $data;

    public function __construct()
    {
        $this->data = [];
    }
}
