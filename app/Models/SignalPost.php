<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalPost extends Model
{
    use HasFactory;

    protected $fillable = ['message','image','post_id','user_id'];

    //Un signal appartient à un Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


   /* public function user()
    {
        return $this->belongsTo(User::class);
    }*/

}
