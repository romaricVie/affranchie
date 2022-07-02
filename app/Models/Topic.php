<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['title','content','image','user_id'];

    /**
         * Get all of the publication's comments.
    */
    // Un topic à un ou plusieurs commentaires
   /**
     * Get all of the Topic 's comments.
     */
    public function comments()
    {
        return $this->morphMany(Commentaire::class, 'commentable');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //Many to Many
    /*Un topic peut etre aime par un ou plusieurs user's */

    public function aimes()
    {
       return $this->belongsToMany(User::class);
    }

}
