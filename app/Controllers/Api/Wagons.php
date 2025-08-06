<?php

namespace App\Controllers\Api;

use App\Models\CoastersModel;
use App\Models\WagonsModel;
use CodeIgniter\RESTful\ResourceController;

class Wagons extends ResourceController
{
    public function create()
    {
        $body = $this->request->getBody();
        $data = json_decode($body, true);
        if (json_last_error()) {
            throw new \Exception();
        }
        $wagon = new WagonsModel($data);
        $wagon->save();
        return $wagon->getId();
    }

    public function delete($idCoaster = null, $idWagon = null): void
    {
        $data['id'] = $idWagon;
        $wagon = new WagonsModel($data);
        $wagon->delete();
    }
}
