<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);

        // \App\Models\WagesRate::factory(10)->create();
        //  \App\Models\ProvidentFund::factory(10)->create();
        //  \App\Models\PTax::factory(10)->create();
        //  \App\Models\Payroll::factory(50)->create();
        //  \App\Models\UserLeave::factory(20)->create();




    }
}
