<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //
    protected $fillable=[
        'user_id','content','commentable_id','commentable_type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    //to get model object that comment under it....(post or portfolio as ex)
    public function commentable(){
        return $this->morphTo();
    }
}
