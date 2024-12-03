<?php

declare(strict_types=1);

namespace ArtisanBuild\Bench\Actions;

use ArtisanBuild\Hallway\Seeders\ChannelsSeeder;
use ArtisanBuild\Hallway\Seeders\GatheringsSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Support\Facades\Artisan;

class SeedDatabase
{
    public function __invoke(): void
    {
        Artisan::call('db:seed', ['class' => UsersSeeder::class]);
        Artisan::call('db:seed', ['class' => ChannelsSeeder::class]);
        Artisan::call('db:seed', ['class' => GatheringsSeeder::class]);
    }
}
