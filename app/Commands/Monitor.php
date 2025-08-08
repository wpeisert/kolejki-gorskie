<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Services\Monitor as MonitorService;

class Monitor extends BaseCommand
{
    public function run(array $params)
    {
        /** @var MonitorService $monitorService */
        $monitorService = service('monitor');
        CLI::write($monitorService->monitor(), 'light_red', 'dark_gray');
    }
}
