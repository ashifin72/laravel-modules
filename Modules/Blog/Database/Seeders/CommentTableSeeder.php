<?php
namespace Modules\Blog\Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Str;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $cName = 'коментатор';
        for ($i = 2; $i <= 20; $i++){
            $data[]=[
                'name' => $cName . '№' . $i,
                'text' => 'Комментарий пользователя' . $cName . '№' . $i,
                'email' => Str::slug($cName . '№' . $i) . '@gmail.com',
                'blog_post_id' => rand(1, 10),
            ];
        }

        DB::table('comments')->insert($data);
    }
}
