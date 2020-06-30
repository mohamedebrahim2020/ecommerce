<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '01227167811',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now()
        ]);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'User']);
        $roleAdmin = Role::where('name', '=', 'Admin')->first();
        $user->assignRole([$roleAdmin->id]);
    }
}
