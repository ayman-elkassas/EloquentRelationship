<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    //
    protected $fillable=[
        'user_id','title','body'
    ];

    public function comments(){
        return $this->morphMany(comments::class,'commentable');
    }
}
