<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalUser extends Model
{
    use HasFactory;


    protected $fillable = ['message','image','user_id','user'];

    

   //Un signal appartient à un user
    public function utilisateur()
    {
        return $this->belongsTo(User::class,"user_id");
    }

}
