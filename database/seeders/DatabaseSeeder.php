<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;


use InfoTableSeeder;
use Modules\Blog\Database\Seeders\BlogCategoriesSeeder;
use Modules\Blog\Database\Seeders\PostSeeders;
use Modules\Blog\Database\Seeders\CommentTableSeeder;
use Modules\Menu\Database\Seeders\MenuItemTableSeeder;
use Modules\Menu\Database\Seeders\MenuTableSeeder;
use Modules\Menu\Entities\MenuItem;
use Modules\Portfolio\Database\Seeders\PortfolioCatigoriesTable;
use Modules\Portfolio\Database\Seeders\PortfolioDatabaseSeeder;
use Modules\Portfolio\Database\Seeders\PortfolioFeedbackTableSeeder;


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
        $this->call(MenuTableSeeder::class);
        $this->call(MenuItemTableSeeder::class);
        $this->call(PortfolioCatigoriesTable::class);
        $this->call(PortfolioDatabaseSeeder::class);
        $this->call(PortfolioFeedbackTableSeeder::class);

    }
}
