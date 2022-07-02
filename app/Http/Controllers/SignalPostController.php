<?php

namespace App\Http\Controllers;

use App\Models\SignalPost;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\SignalPostResource;

class SignalPostController extends Controller
{
    //

    public function store(Request $request, Post $post)
    {
        //
        $request->validate([ 
                          'message' => ['required','string','min:2'],
                          'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:102400'], //100 MO
                          'post_id' => ['exists:posts,id'],
                          'user_id' => ['exists:users,id'],
                          ]);

        $signal = SignalPost::create([
                     'message'=> $request->message,
                     'image'=> $this->storeImage(),
                     'post_id'=> $post->id,
                     'user_id' => auth()->user()->id,
                   ]);

         if($signal){
             return  response()->json([

                     "success" => "Message bien récu"
            ]);

             // new SignalPostResource($signal);
         }else{
            return response()->json([
               "erreur" => "erreur du signal"
            ]);
         }



    }

   
   

     private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('siganal_post_image','public');
      }

      return null;
    }


}
