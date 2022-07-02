<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['message','image','video','communaute_id','user_id'];



    /**
     * Get all of the publication's comments.
     */
    public function comments()
    {
        return $this->morphMany(Commentaire::class, 'commentable');
    }
    
    // page communaute
    //Une publication appartient à une communaute
     public function communaute()
     {
        return $this->belongsTo(Communaute::class);
     }


      //Une publication appartient à une communaute
     public function user()
     {
        return $this->belongsTo(User::class);
     }
     
      
      //Many to Many
      // Page communaute
     // Une publication peut etre aimée pas un ou plusieurs utilisateurs.

    public function loves()
    {
         return $this->belongsToMany(User::class);
    }







}
