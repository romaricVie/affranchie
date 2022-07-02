<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verset extends Model
{
    use HasFactory;

    protected $fillable = ['book','chapter','verse','text','display_at'];

}
