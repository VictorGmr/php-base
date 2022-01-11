<?php

namespace Modules\AuthFortify\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\Application\Entities\Application;
use Modules\AuthFortify\Entities\User;
use Modules\Company\Entities\Company;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Company::whereAlias('admin')->get()->first();
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);
        $admin->users()->saveMany([$user]);

        $application = Application::where('alias','admin')->get()->first();
        $user->applications()->syncWithPivotValues([$application->id], ['company_id' => $admin->id]);

        $users = User::factory(5)->create();
        $admin->users()->saveMany($users);
    }
}
