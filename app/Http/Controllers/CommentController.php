<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentaireResource;
use App\Http\Requests\CommentaireRequest;
use App\Models\Commentaire;
use App\Models\Topic;
use Illuminate\Support\Facades\Gate;
use App\Notifications\TopicCommentNotification;

class CommentController extends Controller
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
    public function store(CommentaireRequest $request, $id)
    {
        //
          $topic = Topic::findOrfail($id);

        if($topic){

                $comment = new Commentaire();
                $comment->comment = $request->comment;
                $comment->user_id = auth()->user()->id; // id le l'utilisateur connecté;
        
           //Relation permettant de récuperer id du Articles,
            $succes = $topic->comments()->save($comment);

            //Send nofication 
             
             $topic->user->notify(new TopicCommentNotification(auth()->user(), $topic));

            if($succes){
                  return response()->json([
                    "success" => "Commentaire ajouté avec succès!"
                 ],201);

                  //new CommentaireResource($comment);
            }else{
                 return response()->json([
                    "erreur" => "Erreur de commentaire"
                 ]);
            }

        }else{
           return response()->json([
                    "erreur" => "impossible  de commenter"
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
        /* $commentaire = Commentaire::findOrfail($id);

         //Authorisation
          $this->authorize('delete', $commentaire);

         if($commentaire){
              $commentaire->delete();

             return response()->json([
                           "message" => "Commentaire supprime avec succes!"
              ]);
         }else{
            return response()->json([
                   "erreur" => "Impossible de supprimer le commentaire"
            ]);
         }*/
         
    }
}
