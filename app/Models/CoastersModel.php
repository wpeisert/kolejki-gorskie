<?php

namespace App\Models;

class CoastersModel
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function save()
    {
        $redis = service('redis');
    }

    public function getId(): ?int
    {
        return $this->data['id'];
    }
}
