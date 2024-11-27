<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;

class WaitForDatabaseAndMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:wait-and-migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wait for the database to be up and run migrations once the database is available';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Waiting for the database to be available...');

        // Define how many attempts you want to make to check if the database is up
        $maxAttempts = 30;
        $attempts = 0;
        $sleepTime = 2; // seconds

        // Keep checking the database until it becomes available or max attempts are reached
        while ($attempts < $maxAttempts) {
            try {
                DB::connection()->getPdo();
                $this->info('Database is up!');
                break;
            } catch (QueryException $e) {
                $this->warn('Database is not available. Retrying...');
                sleep($sleepTime);
                $attempts++;
            }
        }

        // If the database is still not available after max attempts, exit
        if ($attempts === $maxAttempts) {
            $this->error('Unable to connect to the database after multiple attempts.');
            return 1;
        }

        // Run the migrations
        $this->info('Running migrations...');
        Artisan::call('migrate', ['--force' => true]);

        $this->info('Migrations completed successfully!');
        return 0;
    }
}
