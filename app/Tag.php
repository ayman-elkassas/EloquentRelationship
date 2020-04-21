<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable=['name'];

    //like twitter get all twittes that hash tag #...
    public function posts(){
        return $this->morphedByMany(Post::class,'taggable');
    }

    public function portfolios(){
        return $this->morphedByMany(portfolio::class,'taggable');
    }
}
