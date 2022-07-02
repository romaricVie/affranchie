<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = ['comment','user_id'];

      /**
     * Get the parent commentable model (Post, Publication ,Topic).
     */
    public function commentable()
    {
        return $this->morphTo();
    }


     //Un commentaire appartient à un user
     public function user()
     {
        return $this->belongsTo(User::class);
     }

    //Un commentaire appartient à un post
    public function post()
     {
        return $this->belongsTo(Post::class);
     }


     //Un commentaire a un ou plusieurs reponse;
    public function replys()
    {
        return $this->hasMany(Repondre::class);
    }


}
