<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // all posts actif
          $posts = Post::where('status','ACTIF')
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
        // create new posts
         $post = Post::create([
                        'message'=> $request->message,
                        'image'=> $this->storeImage(),
                        'video' => $this->storeVideo(),
                        'menu'=> 'publication',
                        'status'=> 'ACTIF',
                        'user_id' => auth()->user()->id,

                   ]);


         if($post){

              return response()->json([
                   "success" => "Post crée avec succès"
              ],201);
           //  return new PostResource($post);
         }else{
            return response()->json([
               "error" => "erreur de publication du post"
            ]);
         }
       


    }

    /**
     * Display the specified resource.
     * User can share the link
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //findOrfail
        $post = Post::find($id);

        if($post){
             return new PostResource($post);
         }else{
            return response()->json([
                             "error" => "aucun post"
            ],200);
         }
       
    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       $post = Post::findOrfail($id);
       // Authorisation
        $this->authorize('update', $post);

        return response()->json([
              "post" => $post
        ]);
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //
        $post = Post::findOrfail($id);

        // Authorisation
        $this->authorize('update', $post);
        
        if($post){
             $success = $post->update([
          
                        'message'=> $request->message,
                        'image'=> $this->storeImage(),

                      ]);
         if($success){
            return response()->json([
                   "success" => "Post modifié avec succès!"
            ]);

            //new PostResource($post);
        }else{
            return response()->json([
                         "error" => "erreur de modifaction"
            ]);
        }

        }else{
            return response()->json([
               "error" => "Impossible de modifier le post"
            ]);
        }

      

        
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
      $post = Post::find($id);
      //$response = Gate::inspect('delete', $post);

      $this->authorize('delete', $post);

        if($post){
                  $post->delete();
                 return response()->json([
                               "success" => "Post supprime avec succes!"
                  ]);
             }else{
                return response()->json([
                       "error" => "Impossible de supprimer le post"
                ]);
              }
 

        
    }



    public function addLike($id)
    {
        $post = Post::find($id);
         if($post){
           return response()->json([
                "liked" => auth()->user()->likes()->toggle($post->id),
           ],200);
         }
        
    }


    private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('post_image','public');
      }

      return null;
    }


     private function storeVideo()
    {
        if(Request('video')){
            return request()->file('video')->store('videos','public');
        }
        return null; 
    }



     public function search($req)
     {
      

       if($req){

              $posts = Post::where('title','like','%'.$req.'%')
                             ->orWhere('message','like','%'.$req.'%')
                             ->get();

             if(isset($posts)){
                
                 return PostResource::collection($posts);
            }else{
              return response()->json([
                  "error" => "Aucun post pour la recherche"
              ]);

            }


       }
      

     }
    

}
