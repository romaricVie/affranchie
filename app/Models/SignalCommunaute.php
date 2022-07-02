<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalCommunaute extends Model
{
    use HasFactory;

     protected $fillable = ['message','image','communaute_id','user_id'];

     //Un signal appartient à une communaute
    public function communaute()
    {
        return $this->belongsTo(Communaute::class);
    }


   /* public function user()
    {
        return $this->belongsTo(User::class);
    }*/


}
