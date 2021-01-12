<?php
namespace Modules\Portfolio\Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class PortfolioCatigoriesTable extends Seeder
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
                'title_ru' => 'Электронная коммерция',
                'slug' => 'ecommerce',
                'img'=> 'upload/images/img-project.jpg',
                'description_ru' => 'Проекты для продаж товаров и услуг через Интернет',
            ],
            [
                'title_ru' => 'Лендинги',
                'slug' => 'lehd',
                'img'=> 'upload/images/img-project.jpg',
                'description-ru' => ' Олностраничные сайты',
            ],
            [
                'title_ru' => 'Блоги',
                'slug' => 'blogs',
                'img'=> 'upload/images/img-project.jpg',
                'description_ru' => 'Личные блоги',
            ],
            [
                'title_ru' => 'Сайты-визитки для бизнеса',
                'slug' => 'business',
                'img'=> 'upload/images/img-project.jpg',
                'description_ru' => 'Небольшие сайты визитки для представления бизнеса',
            ],
            [
                'title_ru' => 'Корпоративные проекты',
                'slug' => 'corp',
                'img'=> 'upload/images/img-project.jpg',
                'description_ru' => 'Большие проекты с личными кабинетами для сотрудников.',
            ],


        ];
        DB::table('portfolio_categories')->insert($data);
    }
}
