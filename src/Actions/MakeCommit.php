<?php

declare(strict_types=1);

namespace ArtisanBuild\Bench\Actions;

use Illuminate\Support\Facades\Process;

class MakeCommit
{
    public function __construct(private GetProjectAndPackagePaths $projectAndPackagePaths) {}

    public function __invoke(string $message): void
    {
        $paths = ($this->projectAndPackagePaths)();

        foreach ($paths as $path) {
            Process::path($path)->run("git commit -m {$message}");
        }
    }
}
