<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $posts = Post::where("status","ACTIF")
                    ->where('menu','event')
                    ->orderBy('start_at','DESC')
                    ->get();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
         $post = Post::create([
                        'message'=> $request->message,
                        'title'=> $request->title,
                        'date'=> $request->date,
                        'lieu'=> $request->lieu,
                        'image'=> $this->storeImage(),
                        'video' => $this->storeVideo(),
                        'menu'=> 'event',
                        'status'=> 'ACTIF',
                        'user_id' => auth()->user()->id,

                   ]);


         if($post){
             return response()->json([
                   "success" => "Evenement crée avec succès"
             ],201);
            // new PostResource($post);
         }else{
            return response()->json([
               "error" => "erreur de creation du post"
            ]);
         }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('evenement_image','public');
      }

      return null;
    }


    private function storeVideo()
    {
        if(Request('video')){
            return request()->file('video')->store('video_event','public');
        }
        return null; 
    }
}
