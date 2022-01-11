<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AuthFortify\Database\Seeders\AuthFortifyDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthFortifyDatabaseSeeder::class);
    }
}
