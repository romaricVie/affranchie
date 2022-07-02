<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\SignalUser;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;


class ProfilController extends Controller
{
    //

    public function index($id)
    {

    	$user = User::findOrfail($id);
     // $user = User::find($id);
       
    	if($user){

              $posts = Post::where("status","ACTIF")
                          ->where("user_id",$user->id)
                          ->get();
            
         return response()->json([
          
                     "user" => new  UserResource($user),
                     "user_posts" => PostResource::collection($posts),
           ]);
    	}else{
             
              return response()->json([
                         'error' => 'Aucun Utilisateur'
              ]);
    	}

    }



    public function store(Request $request,  User $user)
    {
         //


        $request->validate([ 
                          'message' => ['required','string','min:2'],
                          'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:102400'], //100 MO
                          'user_id' => ['exists:users,id'],
                          'user' => ['exists:users,id'],
                          ]);

        $signal = SignalUser::create([
                     'message'=> $request->message,
                     'image'=> $this->storeImage(),
                     'user_id'=> $user->id,
                     'user' => auth()->user()->id,
                   ]);

         if($signal){
             return response()->json([
                "success" => "Message bien reçu!",
             ]);
         }else{
            return response()->json([
               "error" => "erreur du signal"
            ]);
         }
    }

     private function storeImage()
     {
        if(request('image'))
         {  
            return request()->file('image')->store('siganal_user','public');
         }

           return null;
      }
}
