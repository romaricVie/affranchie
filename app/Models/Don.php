<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;
    
    protected $fillable=['name','firstname','email','phone','nom_produit','description','type','etat_don','point_relais','images','status'];
}
