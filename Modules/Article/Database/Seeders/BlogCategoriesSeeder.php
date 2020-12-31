<?php
namespace Modules\Article\Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Str;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'id'=> 1,
                'title_uk' => $cName ='Без категории',
                'title_ru' => $cName ='Без категории',
                'title_en' => $cName ='Без категории',
                'slug' => Str::slug($cName),
                'parent_id' => 0,
                'sort'=>1,
                'status'=> '1',

            ],
            [
                'id'=> 2,
                'title_uk' => $cName = 'Категория №2',
                'title_ru' => $cName ='Категория №2',
                'title_en' => $cName ='Категория №2',
                'slug' => Str::slug($cName),
                'parent_id' => 1,
                'sort'=>1,
                'status'=> '1',

            ],
            [
                'id'=> 3,
                'title_uk' => $cName = 'Категория №3',
                'title_ru' => $cName ='Категория №3',
                'title_en' => $cName ='Категория №3',
                'slug' => Str::slug($cName),
                'parent_id' => 2,

                'sort'=>1,
                'status'=> '1',

            ],
            [
                'id'=> 4,
                'title_uk' => $cName = 'Категория №4',
                'title_ru' => $cName ='Категория №4',
                'title_en' => $cName ='Категория №4',
                'slug' => Str::slug($cName),
                'parent_id' => 0,

                'sort'=>1,
                'status'=> '1',

            ],
            [
                'id'=> 5,
                'title_uk' => $cName = 'Категория №5',
                'title_ru' => $cName ='Категория №5',
                'title_en' => $cName ='Категория №5',
                'slug' => Str::slug($cName),
                'parent_id' => 4,

                'sort'=>1,
                'status'=> '1',

            ],
            [
                'id'=> 6,
                'title_uk' => $cName = 'Категория №6',
                'title_ru' => $cName ='Категория №6',
                'title_en' => $cName ='Категория №6',
                'slug' => Str::slug($cName),
                'parent_id' => 2,

                'sort'=>1,
                'status'=> '0',

            ],
            [
                'id'=> 7,
                'title_uk' => $cName = 'Категория №7',
                'title_ru' => $cName ='Категория №7',
                'title_en' => $cName ='Категория №7',
                'slug' => Str::slug($cName),
                'parent_id' => 2,

                'sort'=>1,
                'status'=> '1',

            ]

        ];


        DB::table('categories')->insert($categories);
    }
}
