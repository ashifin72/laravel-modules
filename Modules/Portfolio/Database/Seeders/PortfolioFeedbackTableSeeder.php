<?php
namespace Modules\Portfolio\Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class PortfolioFeedbackTableSeeder extends Seeder
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
                'description_ru' => 'Описание RU',
                'description_uk' => 'Опис UA',
                'name_ru' => 'Заказчик RU',
                'name_uk' => 'Замовник UK',
                'portfolio_id' => 1,
                'img'=> 'images/logo-mini.png'
            ],
            [
                'id' => '2',
                'title_ru' => 'Название RU',
                'title_uk' => 'Назва UK',
                'description_ru' => 'Описание RU',
                'description_uk' => 'Опис UA',
                'name_ru' => 'Заказчик RU',
                'name_uk' => 'Замовник UK',
                'portfolio_id' => 2,
                'img'=> 'images/logo-mini.png'
            ],

        ];
        DB::table('portfolio_feedback')->insert($data);
    }
}
