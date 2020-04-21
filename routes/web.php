<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//TODO:Eloquent Relationships..............................

//TODO:1-ONE-TO-ONE

//TODO: ADD USING ELOQUENT

Route::get('/create_user',function (){

    //TODO:Direct add way
    $user=\App\User::create([
        'name'=>'Ayman',
        'email'=>'ayman@outlook.com',
        'password'=>bcrypt('password')
    ]);

    return $user;
});

Route::get('/create_profile',function (){

    //TODO:LEGACY WAY
//    $profile=\App\Profile::create([
//        'user_id'=>2,
//        'phone'=>'2274760',
//        'address'=>'d.str 25'
//    ]);

    //TODO:GOLD WAY
    $user=\App\User::find(1);

    $data=[
        'phone'=>'0000111111',
        'address'=>'jl. Ray.damietta'
    ];

    $user->profile()->create($data);

    return $user;
});

Route::get('update_or_add_user_profile',function (){

    $user=\App\User::find(3);

    $profile=new \App\Profile([
        'phone'=>'01062495243',
        'address'=>'happy mail'
    ]);

    //Todo:save function is updated function that take an object, compared it and update....
    // If profile instance does not exist created and added... (create and update method)
    $user->profile()->save($profile);

    return $user;
});

//TODO: SELECT USING ELOQUENT

Route::get('read_user',function (){

    $user=\App\User::find(1);

//    TODO:return $user->profile;
//     return $user->profile->phone;

    $data=[
        'name'=>$user->name,
        'phone'=>$user->profile->phone,
        'address'=>$user->profile->address
    ];

    return $data;
});

Route::get('read_profile',function (){

    $profile=\App\Profile::where('phone','01062495243')->first();

//  Todo:get user profile data
//    $profile->user;
//     return $profile->user->name;

    $data=[
        'name'=>$profile->user->name,
        'email'=>$profile->user->email,
        'phone'=>$profile->phone,
        'address'=>$profile->address
    ];

    return $data;

});

//TODO: UPDATE USING ELOQUENT

Route::get('update_profile',function (){

    $user=\App\User::find(3);

    $data=[
        'phone'=>'1475369',
        'address'=>'jk. ken, 222'
    ];

    //TODO:CAN CALL profile() AS FUNCTION OR AS STRUCTURE CALL ( profile without () )

    $user->profile()->update($data);

    return $user;
});

//TODO: DELETE USING ELOQUENT
Route::get('delete_profile',function (){

    $user=\App\User::find(1);
    $user->profile()->delete();

    return $user;
});

//TODO:2-ONE-TO-MANY
Route::get('create_post',function (){

    $user=\App\User::findOrFail(3);
    $data=[
        'title'=>'ISi Title Post Admin 1',
        'body'=>'Hello world! Ini isi Admin 1....'
    ];
    $user->posts()->create($data);

    return 'Success';
});

Route::get('read_posts',function(){

    $user=\App\User::find(1);

    //get all posts....
    $posts=$user->posts()->get();

    foreach ($posts as $post){
        $data[]=[
            'name'=>$post->user->name,
            'user_created_id'=>$post->user->id,
            'post_id'=>$post->id,
            'title'=>$post->title,
            'body'=>$post->body
        ];
    }

    //get first post only.....
//    $post=$user->posts()->first();
//    $data=[
//        'name'=>$post->user->name,
//        'title'=>$post->title,
//        'body'=>$post->body
//    ];

    return $data;
});

Route::get('update_post',function (){
    $user=\App\User::findOrFail(1);

//    Method.1
//    $user->posts()->whereId(1)->update([
//       'title'=>'POST TITLE',
//        'body'=>'POST BODY'
//    ]);

    // Method.2
//    $user->posts()->where('id',1)->update([
//        'title'=>'POST TITLE NEW',
//        'body'=>'POST BODY NEW'
//    ]);

    // Method.3 Update All
    $user->posts()->update([
        'title'=>'POST TITLE NEW 2',
        'body'=>'POST BODY NEW 2'
    ]);
    return 'Success';
});

Route::get('delete_post',function (){
    $user=\App\User::findOrFail(1);

//    Method.1
//    $user->posts()->whereId(1)->delete();

    // Method.2
    //select with foreign key uder_id in posts table....
//    $user->posts()->whereUserId(1)->delete();

    //Method 3
    $user->posts()->where('id',1)->delete();

    //Method 4 Delete All
//    $user->posts()->delete();

    return 'success';
});

//TODO:3-MANY-TO-MANY

//Note Migration category_post insert by default when make your relation as following
Route::get('create_category',function (){
    $post=\App\Post::findOrFail(2);

    $post->categories()->create([
        'slug'=>str_slug('Laravel News','_'),
        'category'=>'News'
    ]);

    return 'Success';
});

Route::get('read_category',function(){
    $post=\App\Post::find(2);

    $categories_Of_Post=$post->categories;
    foreach ($categories_Of_Post as $category){
        echo $category->slug .'<br>';
    }
});

//Read All posts that under category
Route::get('read_post_of_category',function (){
    $category=\App\Category::find(1);

    //get all posts that contain under this category
    $posts=$category->posts;
    foreach ($posts as $post){
        echo $post->title . '<br>';
    }

});

//Attach post under category or more
Route::get('/attach',function (){

    //like same if you want to add post with id=2 under category with id=1
    $post=\App\Post::find(2);
    //attach post with id=2 under category 1,3
    $post->categories()->attach([1,3]);

    return 'Success';

});

//Detach post from category
Route::get('detach',function (){

    $post=\App\Post::find(2);
    $post->categories()->detach([1,3]);

    return 'Success';
});

//Sync attach and detach otherwise (if post attach under category (1,2,3) and then sync with
// (1,2) then result attach with 1,2 and detach 3)
Route::get('sync',function (){
    $post=\App\Post::find(2);
    $post->categories()->sync([1,3]);

    return 'Success';
});

//How to get All posts that all accounts as admin share it
//Without direct relationship between Role and Post table through users table
Route::get('role/posts',function (){

    $role=\App\Role::find(1);
    $posts= $role->posts;

    return $posts;
});

//PolyMorphic Relationship.................

//Create new comment
Route::get('comment/create',function (){
    $post=\App\Post::find(2);
//    $portfolio=\App\portfolio::find(1);

    //comment that can use to comment on post or portfolio post, ok? yes
    //Using polymorphic relation can do this can insert comment and can detect automatic ?
    //id with comment under it (post or portfolio)
    //and what type of class (here:post or portfolio)

    $post->comments()->create([
       'user_id'=>1,
        'content'=>'Woooo glgl video amazing one'
    ]);

    return 'Success';
});

//Read comment
Route::get('comment/read',function (){
    $post=\App\Post::findOrFail(1);
    $comments=$post->comments;

    foreach ($comments as $comment){
        echo $comment->user->name . '-' .$comment->content.
            ' ('.$comment->commentable->title.') '.'<br>';
    }
});

//Update comment
Route::get('comment/update',function (){
    $post=\App\Post::find(1);
    $comment=$post->comments()->where('id',5)->first();
    $comment->update([
       'content'=>'updated comment'
    ]);

    return 'Success';

});

//Delete comment
Route::get('comment/delete',function (){
    $post=\App\Post::find(1);
    $comment=$post->comments()->where('id',5)->first();
    $comment->delete();

    return 'Success';

});

Route::get('tags/read',function (){
    $post=\App\Post::find(1);

    foreach ($post->tags as $tag) {
        echo $tag->name . '<br>';
    }
});

Route::get('tag/attach',function(){
    $post=\App\Post::find(1);
    $post->tags()->attach([4,5,6]);

    return 'Success';
});

Route::get('tag/detach',function(){
    $post=\App\Post::find(1);
    $post->tags()->detach([4,5,6]);

    return 'Success';
});

Route::get('tag/sync',function (){
    $post=\App\Post::find(1);
    $post->tags()->sync([4,6]);

    return 'Success';
});




