<?php

declare(strict_types=1);

use ArtisanBuild\Bench\Actions\DumpDatabaseForTesting;
use ArtisanBuild\Bench\Actions\MigrateFresh;
use ArtisanBuild\Bench\Actions\SeedDatabase;

return [
    'bench_directory' => base_path('packages'),
    'fresh-actions' => [
        MigrateFresh::class,
        SeedDatabase::class,
        DumpDatabaseForTesting::class,
    ],
    'run-once' => [
        [

        ],
    ],
];
