<?php

namespace App\Commands;

use ArtisanBuild\Bench\Git\AddSubtreeToPackageDirectory;
use ArtisanBuild\Bench\Packagist\GetGitHubRepositoryFromPackagistRecord;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;
use phpDocumentor\Reflection\Types\Self_;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class AddPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new package to the packages directory';

    /**
     * Execute the console command.
     */
    public function handle(GetGitHubRepositoryFromPackagistRecord $getRepo, AddSubtreeToPackageDirectory $clone)
    {
        if (select(
            label: 'Is this package already in Packagist?',
            options: ['Yes', 'No']
        ) === 'Yes') {
            [$vendor, $package] = explode('/', text('Enter the namespace and package name', placeholder: 'artisan-build/kibble'));

            if (File::isDirectory(base_path('packages/' . $package))) {
                $this->error($package . ' is already in your packages directory.');
                return self::FAILURE;
            }

            $repo = ($getRepo)(vendor: $vendor, package: $package);

            $branch = text('What branch do you want to clone?', default: 'main');

            $result = ($clone)(package: $package, repo: $repo, branch: $branch);

            $this->info($result);

            return self::SUCCESS;

        }
        $this->info('Creating a new package');
        return self::SUCCESS;
    }
}
