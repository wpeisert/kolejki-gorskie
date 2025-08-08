<?php

namespace App\Services;

class Monitor
{
    public function monitor()
    {
        return 'monitoring: ' . time() . "\n";
    }
}