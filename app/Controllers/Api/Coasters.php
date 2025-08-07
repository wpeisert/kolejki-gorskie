<?php

namespace App\Controllers\Api;

use App\Models\CoastersModel;
use CodeIgniter\RESTful\ResourceController;

class Coasters extends ResourceController
{
    public function create()
    {
        $body = $this->request->getBody();
        $data = json_decode($body, true);
        if (json_last_error()) {
            throw new \Exception();
        }
        $coaster = new CoastersModel($data);
        $coaster->save();
        return 'Created coaster ID: ' . $coaster->getIdCoaster();
    }

    public function update($idCoaster = null)
    {
        $body = $this->request->getBody();
        $data = json_decode($body, true);
        if (json_last_error()) {
            throw new \Exception();
        }
        $data['idCoaster'] = $idCoaster;
        $coaster = new CoastersModel($data);
        $coaster->save();
        return 'Updated coaster ID: ' . $coaster->getIdCoaster();
    }
}
