<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priere extends Model
{
    use HasFactory;

    protected $fillable = ['subject','phone','email','image','user_id'];


    //Un sujet de priere avoir un ou plusieurs intercesseurs
   /* public function prieres()
    {
        return $this->belongsToMany(User::class);
    }*/

   //Un sujet de prière appartient à utilisateur
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
