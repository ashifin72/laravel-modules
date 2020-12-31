<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use Modules\Article\Database\Factories\BlogPostFactory;
use InfoTableSeeder;
use Modules\Article\Database\Seeders\BlogCategoriesSeeder;
use Modules\Article\Database\Seeders\PostSeeders;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LocaleSeeder::class);
        $this->call(InfoTableSeeder::class);
        $this->call(BlogCategoriesSeeder::class);
        $this->call(PostSeeders::class);


    }
}
