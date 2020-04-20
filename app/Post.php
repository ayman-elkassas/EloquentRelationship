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
    public function user():object{
        return $this->belongsTo(User::class);
    }

    public function categories():object{
        return $this->belongsToMany(Category::class);
    }

    public function comments():object {
        return $this->morphMany(comments::class,'commentable');
    }
}
