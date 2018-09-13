<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //让我们截断现有的记录从头开始。
        Article::truncate();

        $faker=\Faker\Factory::create();

        //现在，让我们在数据库中创建几篇文章：
        for ($i=0;$i<50;$i++){
            Article::create([
               'title'=>$faker->sentence,
               'body'=>$faker->paragraph,
            ]);
        }
    }
}
