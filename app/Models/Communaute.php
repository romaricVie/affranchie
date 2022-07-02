<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Communaute extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','image','description','status','user_id'];



     //Creaction du slug lors de la creation de l'article;
  protected static function boot()
   {

     parent::boot();
     static::creating(function($event){
       $event->slug = Str::slug($event->name,'-');
     });
   }

    //Une communaute appartient à une communaute
     public function user()
     {
        return $this->belongsTo(User::class);
     }


    
    // Page communaute 
    // Une communaute a un ou plusieurs publications
     public function publications()
     {
        return $this->hasMany(Publication::class);
     }


     //Une Communaute peut avoir un ou plusieurs signales
     public function signales()
     {
          return $this->hasMany(SignalCommunaute::class);
     }


}
