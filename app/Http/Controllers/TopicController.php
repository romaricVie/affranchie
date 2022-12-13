<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TopicResource;
use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Support\Facades\Gate;
//TopicRequest
class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topics = Topic::latest()->get();

        return TopicResource::collection($topics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        //
           $topic = Topic::create([
                        'title'=> $request->title,
                        'image' => $this->storeImage(),
                        'content'=> $request->content,
                        'user_id' => auth()->user()->id,
                   ]);


         if($topic){
               return response()->json([
                       "success" => "Sujet  de discussion crée avec succès"
            ],201);//  new TopicResource($topic);
         }else{
            return response()->json([
               "error" => "erreur de creation du sujet"
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
         //findOrfail
        $topic = Topic::find($id);

        if($topic){
             return new TopicResource($topic);
         }else{
            return response()->json([
                             "error" => "aucun topic"
            ]);
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

       $topic = Topic::findOrfail($id);
       // Authorisation
        $this->authorize('update', $topic);

        return response()->json([
              "topic" => $topic
        ]);
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, $id)
    {
        //

         $topic = Topic::find($id);

        // Authorisation
        $this->authorize('update', $topic);

        if($topic){
             $success = $topic->update([
          
                        'title'=> $request->title,
                        'content'=> $request->content,

                      ]);
         if($success){
            return  response()->json([
                   'success' => 'sujet modifié avec succès!'
            ]);
            //new TopicResource($topic);
        }else{
            return response()->json([
                         "error" => "erreur de modifaction"
            ]);
        }

        }else{
            return response()->json([
               "error" => "Impossible de modifier le topic"
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

          $topic = Topic::find($id);

         //Authorisation
         $this->authorize('delete', $topic);
         
         if($topic){
              $topic->delete();
             return response()->json([
                           "message" => "Topic supprime avec succes!"
              ]);
         }else{
            return response()->json([
                   "error" => "Impossible de supprimer le topic"
            ]);
         }
    }

    public function addLike($id)
    {
        $topic = Topic::find($id);

        if($topic){
            return response()->json([
                "liked" => auth()->user()->aimes()->toggle($topic->id),
           ],200);
        }
    }

    private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('topic_images','public');
      }

      return null;
    }


     public function search($req)
     {
      

       if($req){

              $topics = Topic::where('title','like','%'.$req.'%')
                             ->orWhere('content','like','%'.$req.'%')
                             ->get();

             if(count($topics) > 0 ){
                
                 return TopicResource::collection($topics);
            }else{
              return response()->json([
                  "error" => "Aucun sujet pour la recherche ".$req
              ]);

            }


       }
      

     }



}
