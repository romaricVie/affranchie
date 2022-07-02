<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['message','image','video','title','date','lieu','menu','status','user_id'];


     /**
         * Get all of the publication's comments.
    */
  
   // un Post à un ou plusieurs commentaires
    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Commentaire::class, 'commentable');
    }
 
   /* public function commentaires()
    {
        return $this->morphMany(Commentaire::class, 'commentable');
    }*/


  
    //Un post appartient à  user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Un poste peut avoir plusieurs likes
     public function likes()
    {
        return $this->belongsToMany(User::class);
    }

    //Un post (affranchies) appartient à un ou plusieurs utilisateur ;
    public function affranchies()
    {
        return $this->belongsToMany(User::class, "affranchis","user_id","post_id");
    }

    //Un post peut avoir  a un ou plusieurs signals
     public function signals()
     {
          return $this->hasMany(SignalPost::class);
     }

}
