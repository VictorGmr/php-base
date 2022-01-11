<?php

namespace Modules\AuthFortify\Database\Seeders;

use Illuminate\Database\Seeder;

class AuthFortifyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
    }
}
