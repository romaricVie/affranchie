<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommunauteResource;
use App\Http\Requests\CommunauteRequest;
use App\Models\Communaute;
use Illuminate\Support\Facades\Gate;

class CommunauteController extends Controller
{
    //

     public function index()
    {
        //

        $communautes = Communaute::where('id','>','0')
                                  ->where('status','ON')
                                  ->orderBy('start_at','DESC')
                                  ->get();
        if($communautes){
           return response()->json([
                 "pages" => $communautes
           ]);
        }
    //    return $communautes;
       // return CommunauteResource::collection($communautes);
    }


    public function store(CommunauteRequest $request)
    {
        //
       $communaute = Communaute::create([
                       'name'=> $request->name,
                       'image'=> $this->storeImage(),
                       'description' => $request->description,
                       'status' => 'ON',
                       'user_id' => auth()->user()->id,
                   ]);

         if($communaute){
               return response()->json([
                  "success" => "Page créée avec succès"
               ],201);

               //new CommunauteResource($communaute);
         }else{
            return response()->json([
               "error" => "erreur de creation de communaute"
            ]);
         }

    }


   public function show($id)
    {
        //
         //findOrfail
        $communaute = Communaute::find($id);

        if($communaute){
             return new CommunauteResource($communaute);
         }else{
            return response()->json([
                       "error" => "Aucune page"
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

       $page = Communaute::findOrfail($id);
       // Authorisation
        $this->authorize('update', $page);

        return response()->json([
              "page" => $page
        ]);
        
        
    }



    public function update(Request $request, $id)
    {
        //

         $communaute = Communaute::findOrfail($id);
           // Authorisation
         $this->authorize('update', $communaute);

         
        if($communaute){

          $request->validate([ 
                      'name' => ['required','string','min:2'],
                      'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:10240'], // 10 MO
                      'description' => ['required','string','min:2'],
                      'user_id' => ['exists:users,id'],
                  ]);


             $success = $communaute->update([
                        'name'=> $request->name,
                        'image'=> $this->storeImage()?? $communaute->image,
                        'description' => $request->description

                      ]);
         if($success){
            return response()->json([
                    'success' => "Page modifiée avec succes!"
            ]);
            //new CommunauteResource($communaute);
        }else{
            return response()->json([
                         "error" => "erreur de modifaction"
            ]);
        }

        }else{
            return response()->json([
               "error" => "Impossible de modifier la page"
            ]);
        }



    }


      public function destroy($id)
    {
        //
        
          $communaute = Communaute::findOrfail($id);

         //Authorisation
         $this->authorize('delete', $communaute);

         if($communaute){
              $communaute->delete();
             return response()->json([
                           "message" => "Page supprimée"
              ]);
         }else{
            return response()->json([
                   "error" => "Impossible de supprimer la Page"
            ]);
         }
    }


    private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('communautes_image','public');
      }

      return null;
    }


     public function search($req)
     {
        

       if($req){

            $communautes = Communaute::where('name','like','%'.$req.'%')
                             ->orWhere('description','like','%'.$req.'%')
                             ->get();

           if(isset($communautes)){
               return CommunauteResource::collection($communautes);
            }else{
              return response()->json([
                  "error" => "Aucune communaute pour la recherche"
              ]);

            }


       }
      
   }



}
