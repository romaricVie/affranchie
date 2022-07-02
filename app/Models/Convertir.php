<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convertir extends Model
{
    use HasFactory;
     protected $fillable = [
        'pays', 'ville','habitation','email','phone','motivation','image','user_id'
    ];

     //Une conversion  appartient à  user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
