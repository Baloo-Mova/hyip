<?php

use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\Article::truncate();
            \App\Models\Article::insert([
                [
                    'title' => 'Новость',
                    'uri' => 'novost',
                    'content' => 'Новость на русском языке',
                    'photo' => 'noimg.jpg',
                    'preview' => 'noimg.jpg',
                    'published' => 1,
                    'type_id' => 1,
                    'lang' => 'ru',
                ],
                [
                    'title' => 'News',
                    'uri' => 'novost2',
                    'content' => 'News in english',
                    'photo' => 'noimg.jpg',
                    'preview' => 'noimg.jpg',
                    'published' => 1,
                    'type_id' => 1,
                    'lang' => 'en',
                ],
                [
                    'title' => 'Акция',
                    'uri' => 'aktsia',
                    'content' => 'Акция на русском языке',
                    'photo' => 'noimg.jpg',
                    'preview' => 'noimg.jpg',
                    'published' => 1,
                    'type_id' => 2,
                    'lang' => 'ru',
                ],
                [
                    'title' => 'Stock',
                    'uri' => 'stock',
                    'content' => 'Stock in english',
                    'photo' => 'noimg.jpg',
                    'preview' => 'noimg.jpg',
                    'published' => 1,
                    'type_id' => 2,
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
