<?php

declare(strict_types=1);

namespace ArtisanBuild\Bench\Actions;

use Illuminate\Support\Facades\Process;

class HasUnpushedCommits
{
    public function __invoke($path): bool
    {
        return ! blank(Process::path($path)->run('git log @{u}..')->output());
    }

}
