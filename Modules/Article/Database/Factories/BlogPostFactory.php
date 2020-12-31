<?php
namespace Modules\Article\Database\Factories;

use Illuminate\Support\Str;
use Modules\Article\Entities\Post;
use Faker\Generator as Faker;


$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(rand(1, 8), true);
    $txt = $faker->realText(rand(1000, 4000));

    $createdAt = $faker->dateTimeBetween('-3 months', '-2 days');
    $data = [
        'category_id' => rand(1, 7),
        'user_id' => (rand(1, 5) == 5) ? 1 : 2,
        'title_uk' => $title,
        'title_ru' => $title,
        'title_en' => $title,
        'slug'=> Str::slug($title),
        'description_uk'=>$faker->text(rand(40,100)),
        'description_ru'=>$faker->text(rand(40,100)),
        'description_en'=>$faker->text(rand(40,100)),
        'content_uk' => $txt,
        'content_ru' => $txt,
        'content_en' => $txt,

        'img'=> '/upload/files/thumbnail/img.jpg',


        'created_at' => $createdAt,
        'updated_at' => $createdAt,

    ];
    return $data;

});
