<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Resources\AffranchiResource;
use App\Http\Resources\PostResource;

class AffranchiController extends Controller
{
    //
   
    public function store($id)
    {


        $post = Post::findOrfail($id);
        if($post){
             return response()->json([

                 "Affranchie" => auth()->user()->affranchis()->toggle($post->id),
             ]);
        }



    }

    public function index($id)
    {
     
           // $user = User::find($id);

         
    	$user = User::find($id);

        //return $user->affranchis;

    	if(auth()->user()->id == $user->id)
    	{
             return new AffranchiResource($user);
    	}else{
            return response()->json([
               "error" => "accès non autorisé!"
            ]);
        }
    	



    }



}
