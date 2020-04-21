<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    //
    protected $fillable=[
        'user_id','title','body'
    ];

    //Polymorphic Concept:
    //To Enable one relation for purpose that may used in different relation
    //Such as comments and tags (may comment under post portfolio and same tags person)
    public function comments(){
        return $this->morphMany(comments::class,'commentable');
    }

    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }
}
