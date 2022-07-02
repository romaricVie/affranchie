<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;

    //Un role appartient à un ou plusieurs Utilisateurs.
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }


}
