<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class Fresh extends Command
{
    protected $signature = 'app:fresh';

    protected $description = 'Fresh migration, seeders, oauth secrets and users.';

    public function handle(): void
    {
        if (App::environment(['production',])) {
            $this->info('You cannot run this command on production!');

            return;
        }

        // Clear cache
        $this->call('cache:clear');

        // Drop database tables and migrate
        $this->call('migrate:fresh');

        // Seed roles
        $this->call('db:seed');
    }
}
