<?php
namespace Modules\Menu\Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class MenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'title_ru' => 'Главная',
                'title_uk' => 'Головна',
                'path' => '/',
                'menu_id' => 1,
            ],
            [
                'id' => '2',
                'title_ru' => 'Контакты',
                'title_uk' => 'Контакти',
                'path' => '/contact',

                'menu_id' => 1,
            ],

        ];
        DB::table('menu_items')->insert($data);
    }
}
