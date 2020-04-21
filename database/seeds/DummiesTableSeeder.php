<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DummiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles=[
            ['role'=>'Admin'],
            ['role'=>'Member']
        ];

        DB::table('roles')->insert($roles);

        $users=[
            ['name'=>'Admin','email'=>'admin@gmail.com','password'=>bcrypt('password'),
                'role_id'=>1],
            ['name'=>'Member','email'=>'member@gmail.com','password'=>bcrypt('password'),
                'role_id'=>2]
        ];

        DB::table('users')->insert($users);

        $posts=[
            ['user_id'=>1,'title'=>'POST1 USER 1','body'=>'HELLO1'],
            ['user_id'=>1,'title'=>'POST2 USER 1','body'=>'HELLO2'],
            ['user_id'=>2,'title'=>'POST1 USER 2','body'=>'HELLO1'],
            ['user_id'=>2,'title'=>'POST2 USER 2','body'=>'HELLO2'],
        ];

        DB::table('posts')->insert($posts);

        $categories=[
          ['slug'=>'web-programming','category'=>'Web Programming'],
          ['slug'=>'desktop-programming','category'=>'Desktop Programming'],
        ];

        DB::table('categories')->insert($categories);

        $category_post=[
          ['post_id'=>1,'category_id'=>1],
          ['post_id'=>1,'category_id'=>2],
          ['post_id'=>2,'category_id'=>1],
          ['post_id'=>2,'category_id'=>2],
          ['post_id'=>3,'category_id'=>1],
          ['post_id'=>3,'category_id'=>2],
        ];

        DB::table('category_post')->insert($category_post);

        $portfilos=[
          ['user_id'=>1,'title'=>'Ayman Portfolio 1 Admin','body'=>'Bio 1'],
          ['user_id'=>1,'title'=>'Ayman Portfolio 2 Admin','body'=>'Bio 2'],
          ['user_id'=>2,'title'=>'Ayman Portfolio 1 Member','body'=>'Bio 1'],
          ['user_id'=>2,'title'=>'Ayman Portfolio 2 Member','body'=>'Bio 2'],
        ];

        DB::table('portfolios')->insert($portfilos);

        $comments=[
            ['user_id'=>2,'content'=>'Content 1','commentable_id'=>1,'commentable_type'=>'App/Post'],
            ['user_id'=>1,'content'=>'Content 1','commentable_id'=>1,'commentable_type'=>'App/Post'],
            ['user_id'=>2,'content'=>'Content 1','commentable_id'=>1,'commentable_type'=>'App/portfolio'],
            ['user_id'=>1,'content'=>'Content 1','commentable_id'=>1,'commentable_type'=>'App/portfolio'],
        ];

        DB::table('comments')->insert($comments);

        $tags=[
            ['name'=>'Post'],
            ['name'=>'Portfolio']
        ];

        DB::table('tags')->insert($tags);

        $taggable=[
            ['tag_id'=>1,'taggable_id'=>1,'taggable_type'=>'App/Post'],
            ['tag_id'=>2,'taggable_id'=>1,'taggable_type'=>'App/portfolio'],
        ];

        DB::table('taggables')->insert($taggable);
    }
}
