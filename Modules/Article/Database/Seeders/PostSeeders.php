<?php


namespace Modules\Article\Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Str;
use Faker\Generator as Faker;

class PostSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()   {
        $text = 'Текст статьи';
        $data = [];
        $title = 'Статья';

        for ($i = 2; $i <= 20; $i++){
            $data[]=[
                'category_id' => rand(1, 5),
                'user_id' => (rand(1, 5) == 5) ? 1 : 2,
                'title_uk' => $title. '№' . $i,
                'title_ru' => $title. '№' . $i,
                'title_en' => $title. '№' . $i,
                'slug'=> Str::slug($title. '№' . $i),
                'description_uk'=>$text . '№' . $i,
                'description_ru'=>$text . '№' . $i,
                'description_en'=>$text . '№' . $i,
                'content_uk' => $text . '№' . $i,
                'content_ru' => $text . '№' . $i,
                'content_en' => $text . '№' . $i,
                'img'=> '/upload/files/thumbnail/img.jpg',

            ];
        }
        DB::table('posts')->insert($data);
    }
}
