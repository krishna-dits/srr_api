<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 3; $i++) { 
            
            if ($i == 1) {

                //CREATEING SUPER-ADMIN
                // $superadmin = User::create([
                //     'name' => 'Super-admin',
                //     'email' => 'superadmin@superadmin.com',
                //     'password' => Hash::make('12345678'),
                // ]);
                // $superadmin->assignRole('Super-Admin');

            }elseif($i == 2){

                //CREATEING ADMIN
                $admin = User::create([
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('12345678'),
                    'role_as' => 'admin'
                ]);

                $admin->assignRole('admin');
                
            }else{

                //CREATEING USERs
                $normaluser = User::create([
                    'name' => 'user'.$i,
                    'email' => 'user'.$i.'@user.com',
                    'password' => Hash::make('12345678'),
                    'role_as' => 'user'
                ]);

                $normaluser->assignRole('user');

            }

        }
    }
}
