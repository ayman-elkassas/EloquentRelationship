<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //todo:One-to-One Relationship

    protected $fillable=[
        'user_id','phone','address'
    ];

    /*
     * Todo:Define an inverse One-to-one or One-to-many relationship.
     */
    public function user():object{
        return $this->belongsTo(User::class);
    }
}
