<?php

namespace App\Models;

class WagonsModel
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

    public function delete()
    {
        $redis = service('redis');
    }

    public function getId(): ?int
    {
        return $this->data['id'];
    }
}
