<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PriereRequest;
use App\Models\Priere;
use App\Http\Resources\PriereResource;
use Illuminate\Support\Facades\Gate;

class PriereController extends Controller
{
    //

    public function index()
    {
        $prieres = Priere::latest()->get();
       return PriereResource::collection($prieres);
       
    }

     public function show($id)
     {
        $priere = Priere::findOrfail($id);
        
       if($priere){
             return new PriereResource($priere);
         }else{
            return response()->json([
                             "error" => "Aucun sujet de priere"
            ]);
         }
       
       
     }


    public function store(PriereRequest $request)
    {
    	$priere = Priere::create([

						        "phone"=>$request->phone,
						        "email"=>$request->email,
						        "subject"=>$request->subject,
						        "image"=>$this->storeImage(),
						        "user_id"=>auth()->user()->id,

						     ]);

    	if($priere){
             return response()->json([
                                "success" => "Sujet de prière crée avec succès!"
                ],201);
         }else{
            return response()->json([
                        "erreur" => "Une erreur s'est produite, veuillez réessayer"
            ]);
         }
      

    }


    //destroy
     public function destroy($id)
    {
        //
      $priere = Priere::findOrfail($id);
      //$response = Gate::inspect('delete', $post);
      $this->authorize('delete', $priere);
      
    //  $this->authorize('delete', $post);

        if($priere){
                  $priere->delete();
                 return response()->json([
                               "success" => "sujet supprimé avec succes!"
                  ]);
             }else{
                return response()->json([
                       "error" => "Impossible de supprimer le sujet"
                ]);
              }

        
    }


    public function prie($id)
    {
        $priere = Priere::find($id);
        return auth()->user()->prieres()->toggle($priere->id);
    }


    private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('priere_image','public');
      }

      return null;
    }


}
