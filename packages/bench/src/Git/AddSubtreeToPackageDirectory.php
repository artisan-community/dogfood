<?php

namespace ArtisanBuild\Bench\Git;


use Illuminate\Support\Facades\Process;

class AddSubtreeToPackageDirectory
{
    public function __invoke(string $repo, string $branch): string
    {
        $process = Process::run("git subtree add --prefix packages $repo $branch --squash");
        dd($process);
        return $process->output();
    }
}
