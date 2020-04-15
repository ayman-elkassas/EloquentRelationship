<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=[
        'user_id','title','body'
    ];

    /*
     * Todo:Define an inverse One-to-one or One-to-many relationship.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
