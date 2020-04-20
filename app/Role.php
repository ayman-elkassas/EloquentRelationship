<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable=['role'];

    public function posts():object {
        return $this->hasManyThrough(Post::class,
            User::class,
            'role_id','user_id','id','id');
    }

    //Example to show benefits.......

    //How can access every posts related to specific country, Despite no relationship
    //between them but users table is middle relation between them...

//    public function posts()
//    {
//        return $this->hasManyThrough(
//            'App\Post',
//            'App\User',
//            'country_id', // Foreign key on users table...
//            'user_id', // Foreign key on posts table...
//            'id', // primary (local) key on countries table...
//            'id' // primary (local) key on users table...
//        );
//    }
}
