<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = Role::where('slug','admin')->first();
        $manager = Role::where('slug', 'project-manager')->first();
        $createTasks = Permission::where('slug','create-tasks')->first();
        $manageUsers = Permission::where('slug','user')->first();
        $user1 = new User();
        $user1->name = 'Fedor Ashifin';
        $user1->email = 'a@a.com';
        $user1->img = 'images/users/users4/mgtuAqIz1Xm0xbQnq0d73pglJxGyMh2RqWUlpFPF.jpg';
        $user1->password = bcrypt(123456789);
        $user1->save();
        $user1->roles()->attach($developer);
        $user1->permissions()->attach($createTasks);
        $user2 = new User();
        $user2->name = 'Mike Manager';
        $user2->email = 'manager@manager.com';
        $user2->password = bcrypt(123456789);
        $user2->save();
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($manageUsers);
        $user3 = new User();
        $user3->name = '3 Manager';
        $user3->email = 'manage3r@manager.com';
        $user3->password = bcrypt(123456789);
        $user3->save();
        $user3->roles()->attach($manager);
        $user3->permissions()->attach($manageUsers);
        $user4 = new User();
        $user4->name = '4 Manager';
        $user4->email = '4r@manager.com';
        $user4->password = bcrypt(123456789);
        $user4->save();
        $user4->roles()->attach($manager);
        $user4->permissions()->attach($manageUsers);
        $user5 = new User();
        $user5->name = '5 Manager';
        $user5->email = '5r@manager.com';
        $user5->password = bcrypt(123456789);
        $user5->save();
        $user5->roles()->attach($manager);
        $user5->permissions()->attach($manageUsers);
    }
}
