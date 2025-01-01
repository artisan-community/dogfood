<?php

namespace App\Pipeline;

use App\Package;

class HasUncommittedChanges
{
    public function __invoke(Package $package, \Closure $next)
    {
        return $next($package);
    }
}
