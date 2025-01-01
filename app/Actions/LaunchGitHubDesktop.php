<?php

namespace App\Actions;

use Illuminate\Support\Facades\Process;

class LaunchGitHubDesktop
{
    public function __invoke(string $path = '.')
    {
        Process::run("github $path");
    }
}
