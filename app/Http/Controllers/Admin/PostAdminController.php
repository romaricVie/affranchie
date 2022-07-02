<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SignalPost;
use App\Models\Post;
use App\Http\Resources\SignalPostResource;
use Illuminate\Support\Facades\Gate;

class PostAdminController extends Controller
{
    //
   
   // posts signalés 
    public function index()
    {
    	   $response = Gate::inspect('manage-users');
         if($response->allowed()){
             return SignalPostResource::collection(SignalPost::orderByDesc("created_at")->get());
         }else{
            
            return $response->message();
         }
       
    }

 
  // 
    public function bloquer(Post $post)
    {
    	   //Authorisation
       $response = Gate::inspect('manage-users');

         if($response->allowed()){
             if($post->status=='ACTIF'){

                 $post->status ="INACTIF";
                 $post->update(['status' => $post->status]);     

               return response()->json(['success' => "Post bloqué avec succès !"]);
              }else{
                return response()->json(['success' => "Post déjà bloqué avec succès !"]);
              }
          }else{

             return $response->message();
         }

       
    }


    public function activer(Post $post)
    {
    	 //Authorisation
        $response = Gate::inspect('manage-users');
        
        if($response->allowed()){
             if($post->status=='INACTIF'){

                   $post->status ="ACTIF";
                   $post->update(['status' => $post->status]);     

                   return response()->json(['success' => "Post activé avec succès !"]);
             }else{
                  return response()->json(['success' => "Post déjà activé avec succès !"]);
            }
            }else{

                 return $response->message();
            }


    }


    // supprimer

    public function supprimer(SignalPost $signal)
    {
        //Authorisation
         $response = Gate::inspect('manage-users');
         if($response->allowed()){
              $signal->delete();
              return response()->json(['success' => "Signal supprimer avec succès !"]);
         }else{
             return $response->message();
         }
       
    }


     //supprimer post
    public function destroy(Post $post)
    {
        //Authorisation
        $response = Gate::inspect('manage-users');

        if($response->allowed()){
              $post->delete();
              return response()->json(['success' => "Post supprimer avec succès !"]); 
        }else{
         return $response->message();
        }
       
        
    }
  


  

}
