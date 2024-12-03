<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use function Laravel\Prompts\select;

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
    public function handle()
    {
        if (select(
            label: 'Is this package already on GitHub?',
            options: ['Yes', 'No']
        ) === 'Yes') {
            $this->info('Package is already on GitHub');


        }
        $this->info('Creating a new package');
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
