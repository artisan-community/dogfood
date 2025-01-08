<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use function Laravel\Prompts\text;

class ImportPackageCommand extends Command
{
    protected $signature = 'repo:import';
    protected $description = 'Import a repository into the monorepo with its history';

    public function handle()
    {
        $repoUrl = text('Enter the repository URL');
        $repoName = text('Enter the package name (used as directory)');
        $repoPath = text('Enter the package path (leave blank to use the name)', default: $repoName);

        $this->info("Cloning $repoUrl into packages/$repoPath...");

        File::ensureDirectoryExists(base_path('packages'));

        chdir(base_path());

        $emptyTree = trim(Process::run('git hash-object -t tree /dev/null')->output());

        Process::run("git remote add $repoName $repoUrl");
        Process::run("git config --add remote.$repoName.fetch '+refs/tags/*:refs/tags/$repoName/*'");
        Process::run("git config remote.$repoName.tagOpt --no-tags");
        Process::run("git fetch --atomic $repoName");

        $branches = explode("\n", trim(Process::run("git branch -r --no-color --list '$repoName/*' --format '%(refname:lstrip=3)'")->output()));

        foreach ($branches as $branch) {
            if (empty($branch)) {
                continue;
            }

            // Create an empty tree
            Process::run("git read-tree $emptyTree");
            Process::run("git read-tree --prefix=packages/$repoPath refs/remotes/$repoName/$branch");
            $tree = trim(Process::run('git write-tree')->output());

            $moveCommit = trim(Process::run("git commit-tree $tree -p refs/remotes/$repoName/$branch -m 'Move all files to $repoPath/'")->output());

            $branchExists = Process::run("git show-ref --verify --quiet refs/heads/$branch")->successful();

            if (!$branchExists) {
                $rootCommit = trim(Process::run("git commit-tree $emptyTree -m 'Root commit for monorepo branch $branch'")->output());
                Process::run("git branch -- $branch $rootCommit");
            }

            Process::run("git symbolic-ref HEAD refs/heads/$branch");
            Process::run("git reset -q");

            Process::run("git read-tree --prefix=packages/$repoPath refs/remotes/$repoName/$branch");
            $tree = trim(Process::run('git write-tree')->output());

            $mergeCommit = trim(Process::run("git commit-tree $tree -p $branch -p $moveCommit -m 'Merge $repoName/$branch'")->output());
            Process::run("git reset -q $mergeCommit");
        }

        Process::run('git checkout .');

        $this->info("Repository $repoName imported into packages/$repoPath.");
    }
}
