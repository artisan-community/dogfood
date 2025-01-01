<?php

namespace App\Pipeline;

use App\Package;

class GetNextReleaseLevel
{
    public function __invoke(Package $package, \Closure $next)
    {
        return $next($package);
    }
}
