<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Model\Post::class,20)->create()->each(function ($u){
//
//            $u->posts->save(factory('App\Model\Post')->make());
//
//        });

        factory(App\Model\Post::class,20)->create(); //创建模型实例，并保存至数据库
    }
}
