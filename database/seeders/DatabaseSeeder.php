<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;

use Modules\Blog\Database\Factories\BlogPostFactory;
use InfoTableSeeder;
use Modules\Blog\Database\Seeders\BlogCategoriesSeeder;
use Modules\Blog\Database\Seeders\PostSeeders;
use Modules\Blog\Database\Seeders\CommentTableSeeder;

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
        $this->call(CommentTableSeeder::class);


    }
}
