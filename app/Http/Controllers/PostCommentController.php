<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentaireResource;
use App\Http\Requests\PostCommentRequest;
use App\Models\Commentaire;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use App\Notifications\PostCommentNotification;

class PostCommentController extends Controller
{
    //

      public function store(PostCommentRequest $request, $id)
      {
        //
          $post = Post::findOrfail($id);
        //  return $post;
        

        if($post){

                $comment = new Commentaire();
                $comment->comment = $request->comment;
                $comment->user_id = auth()->user()->id; // id le l'utilisateur connecté;
        
           //Relation permettant de récuperer id du Articles,
            $succes = $post->comments()->save($comment);

            //Send nofication 
             
             $post->user->notify(new PostCommentNotification(auth()->user(),$post));
             

            if($succes){
                  return  response()->json([
                    "success" => "Commentaire ajouté avec succès"
                 ]);
                  //new CommentaireResource($comment);
            }else{
                 return response()->json([
                    "error" => "Erreur lors du commentaire"
                 ]);
            }

        }else{
           return response()->json([
                    "error" => "impossible  de commenter"
                 ]);
        }
    }

     public function destroy($id)
    {
        //
      /*
         $commentaire = Commentaire::find($id);

         //Authorisation
         $this->authorize('delete', $commentaire);
         
         if($commentaire){
              $commentaire->delete();

             return response()->json([
                           "success" => "Commentaire supprimé avec succes!"
              ]);
         }else{
            return response()->json([
                   "error" => "Impossible de supprimer le commentaire"
            ]);
         }
    */
}


}
