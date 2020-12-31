<?php

namespace Database\Seeders;

use App\Models\locale;
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
        $locale_uk = new Locale();
        $locale_uk->local = 'uk';
        $locale_uk->name = 'Українська';
        $locale_uk->favorite = '1';
        $locale_uk->status = '1';
        $locale_uk->sort = 1;
        $locale_ru = new Locale();
        $locale_ru->local = 'ru';
        $locale_ru->name = 'Русский';
        $locale_ru->favorite = '1';
        $locale_ru->status = '1';
        $locale_ru->sort = 1;
        $locale_en = new Locale();
        $locale_en->local = 'en';
        $locale_en->name = 'English';
        $locale_en->favorite = '1';
        $locale_en->status = '1';
        $locale_en->sort = 1;
    }
}
