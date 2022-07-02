<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PublicationResource;
use App\Http\Requests\PublicationRequest;
use App\Models\Publication;
use App\Models\Communaute;
use Illuminate\Support\Facades\Gate;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicationRequest $request, $id)
    {
        //
         //
         $communaute = Communaute::find($id);

      if($communaute){
            if(auth()->user()->id == $communaute->user->id){

                      $publication = Publication::create([
                                          'message'=> $request->message,
                                          'image'=> $this->storeImage(),
                                          'video' => $this->storeVideo(),
                                          'communaute_id'=> $communaute->id,
                                          'user_id' => auth()->user()->id,
                                        ]);

                     if($publication){
                          return response()->json([
                                     "success" => "Publication créée avec succès!"
                              ]);
                         //new PublicationResource($publication);
                     }else{
                        return response()->json([
                           "error" => "erreur de publication du post"
                        ]);
                     }

            
             }else{
                 return response()->json([
                          "error" => "Seul l'admin peut publier dans cette page"
                 ]);
             }
        }else{
            return response()->json([
                  "error" => "Aucune page"
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
       $publication = Publication::find($id);

        if($publication){
             return new PublicationResource($publication);
         }else{
            return response()->json([
                             "error" => "aucune publication"
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

       $publication = Publication::findOrfail($id);
       // Authorisation
        $this->authorize('update', $publication);

        return response()->json([
              "publication" => $publication
        ]);
        
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublicationRequest $request, $id)
    {
        //

         $publication = Publication::find($id);

        // Authorisation
         $this->authorize('update', $publication);

        if($publication){
             $success = $publication->update([

                        'message'=> $request->message,

                      ]);
         if($success){
            return response()->json([
                    "success" => "Publication modifiée avec succès"
            ]);

            //new PublicationResource($publication);
        }else{
            return response()->json([
                         "error" => "erreur de modifaction"
            ]);
        }

        }else{
            return response()->json([
               "erreur" => "Impossible de modifier le post"
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
         $publication = Publication::find($id);

         //Authorisation
       $this->authorize('delete', $publication);

         if($publication){
              $publication->delete();
             return response()->json([
                           "success" => "Publication supprimée avec succes!"
              ]);
         }else{
            return response()->json([
                   "error" => "Impossible de supprimer la publication"
            ]);
         }
    }


     public function addLike($id)
    {
        $publication = Publication::find($id);
         if($publication){
            return response()->json([
                "liked" => auth()->user()->loves()->toggle($publication->id),
           ],200);
         }
        
    }


      private function storeImage()
     {
          if(request('image'))
          {  
              return request()->file('image')->store('publications_image','public');
          }

          return null;
    }


    private function storeVideo()
    {
        if(Request('video')){
            return request()->file('video')->store('video_communautes','public');
        }
        return null; 
    }
}
