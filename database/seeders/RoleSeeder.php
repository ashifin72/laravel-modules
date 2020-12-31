<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'Project Manager';
        $manager->slug = 'project-manager';
        $manager->save();
        $user = new Role;
        $user->name = 'User';
        $user->slug = 'user';
        $user->save();
        $disabled = new Role;
        $disabled->name = 'Disabled';
        $disabled->slug = 'disabled';
        $disabled->save();
        $developer = new Role();
        $developer->name = 'Admin';
        $developer->slug = 'admin';
        $developer->save();
    }
}
