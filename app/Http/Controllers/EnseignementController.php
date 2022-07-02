<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;

class EnseignementController extends Controller
{
    //

     public function index()
    {
        //
         $posts = Post::where("status","ACTIF")
                    ->where('menu','enseignement')
                    ->orderBy('start_at','DESC')
                    ->get();

        return PostResource::collection($posts);
    }

    public function store(PostRequest $request)
    {
        //
         $post = Post::create([
                        'message'=> $request->message,
                        'title'=> $request->title,
                        'image'=> $this->storeImage(),
                        'video' => $this->storeVideo(),
                        'menu'=> 'enseignement',
                        'status'=> 'ACTIF',
                        'user_id' => auth()->user()->id,

                   ]);


         if($post){
             return response()->json([
                        "success" => "Enseignement crée avec succès"
             ]);

             //new PostResource($post);
         }else{
            return response()->json([
               "error" => "erreur de creation du post"
            ]);
         }
       
    }

    private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('evenements_image','public');
      }

      return null;
    }


    private function storeVideo()
    {
        if(Request('video')){
            return request()->file('video')->store('video_enseignement','public');
        }
        return null; 
    }

}
