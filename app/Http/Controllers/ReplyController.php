<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Repondre;
use App\Http\Requests\RepondreRequest;

class ReplyController extends Controller
{
    //
   
    public function store(RepondreRequest $request, $id)
    {
        //

        $comment = Commentaire::findOrfail($id);
        // return $comment->id;
        if($comment){

                $repondre = new Repondre();
                $repondre->reply = $request->reply;
                $repondre->commentaire_id = $comment->id;
                $repondre->user_id = auth()->user()->id; // id le l'utilisateur connecté;
        
           //Relation permettant de récuperer id du Articles,
            $succes = $comment->replys()->save($repondre);
            if($succes){
                  return response()->json([
                    "success" => "Reponse ajoutée avec succes"
                 ]);
            }else{
                 return response()->json([
                    "error" => "Erreur de reponse"
                 ]);
            }

        }else{
           return response()->json([
                    "error" => "impossible  de repondre"
                 ]);
        }



    }

}
