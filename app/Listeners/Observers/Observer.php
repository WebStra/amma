<?php

namespace App\Listeners\Observers;

class Observer
{
    public function recordLogs()
    {
        return config('app.observers_logs');
    }
}