<?php

namespace Modules\Portfolio\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Str;

class PortfolioDatabaseSeeder extends Seeder
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
                'id'=> 1,
                'title_ru' =>  $cName ='Заказ 1',
                'title_uk' =>  $cName,
                'slug' => Str::slug($cName),
                'description_ru' => 'Описание проекта' . $cName,
                'img'=> 'images/logo_b.png',
                'content_ru'=> 'Полное Описание проекта' . $cName,



            ],
            [
                'id'=> 2,
                'title_ru' =>  $cName ='Заказ 2',
                'title_uk' =>  $cName,
                'slug' => Str::slug($cName),
                'description_ru' => 'Описание проекта' . $cName,
                'img'=> 'images/logo_b.png',
                'content_ru'=> 'Полное Описание проекта' . $cName,



            ],
            [
                'id'=> 3,
                'title_ru' =>  $cName ='Заказ 3',
                'title_uk' =>  $cName,
                'slug' => Str::slug($cName),
                'description_ru' => 'Описание проекта' . $cName,
                'img'=> 'images/logo_b.png',
                'content_ru'=> 'Полное Описание проекта' . $cName,


            ],
            [
                'id'=> 4,
                'title_ru' =>  $cName ='Заказ 4',
                'title_uk' =>  $cName,
                'slug' => Str::slug($cName),
                'description_ru' => 'Описание проекта' . $cName,
                'img'=> 'images/logo_b.png',
                'content_ru'=> 'Полное Описание проекта' . $cName,



            ],
            [
                'id'=> 5,
                'title_ru' =>  $cName ='Заказ 5',
                'title_uk' =>  $cName,
                'slug' => Str::slug($cName),
                'description_ru' => 'Описание проекта' . $cName,
                'img'=> 'images/logo_b.png',
                'content_ru'=> 'Полное Описание проекта' . $cName,


            ],


        ];
        DB::table('portfolios')->insert($data);
    }
}
