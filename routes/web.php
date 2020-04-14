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
    $user=\App\User::find(4);

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

//TODO:1-ONE-TO-MANY
Route::get('create_post',function (){

    $user=\App\User::findOrFail(1);
    $data=[
        'title'=>'ISi Title Post',
        'body'=>'Hello world! Ini isi....'
    ];
    $user->posts()->create($data);

    return 'Success';
});
