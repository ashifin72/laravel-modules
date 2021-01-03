<?php

namespace Database\Seeders;

use App\Models\locale;
use DB;
use Illuminate\Database\Seeder;

class LocaleSeeder extends Seeder
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
                'local' => 'uk',
                'name' => 'Українська',
                'favorite' => '1',
                'status' => '1',

            ],
            [
                'id' => '2',
                'local' => 'ru',
                'name' => 'Русский',
                'favorite' => '0',
                'status' => '1',
            ],
            [
                'id' => '3',
                'local' => 'en',
                'name' => 'English',
                'favorite' => '0',
                'status' => '0',
            ],

        ];
        DB::table('locales')->insert($data);
    }
}
