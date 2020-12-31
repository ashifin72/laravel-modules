<?php

use Illuminate\Database\Seeder;

class InfoTableSeeder extends Seeder
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
                'title_ru' => 'Название RU',
                'title_uk' => 'Назва UK',
                'description_ru' => 'Описание фирмы',
                'description_uk' => 'Опис фірми',
                'operating_time_ru' => 'время работы',
                'operating_time_uk' => 'час роботи'
            ],

        ];
        DB::table('infos')->insert($data);
    }
}
