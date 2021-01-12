<?php
namespace Modules\Menu\Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
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
                'name' => 'TOP menus',

            ],
            [
                'id' => '2',
                'name' => 'Sidebar menus',
            ],

        ];
        DB::table('menus')->insert($data);
    }
}
