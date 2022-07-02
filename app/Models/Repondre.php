<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repondre extends Model
{
    use HasFactory;
    protected $fillable = ['reply','user_id','commentaire_id'];

    //Un commentaire appartient à un user
     public function user()
     {
        return $this->belongsTo(User::class);
     }

     //Une reponse appartient à  commentaire
    public function reply()
    {
        return $this->belongsTo(Commentaire::class);
    }
}
