<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SignalCommunaute;
use App\Models\Communaute;
use App\Http\Resources\SignalCommunauteResource;
use Illuminate\Support\Facades\Gate;


class CommunauteAdminController extends Controller
{
    //

     //Communautés signalées

    public function index()
    {
       $response = Gate::inspect('manage-users');
       if($response->allowed()){
           return SignalCommunauteResource::collection(SignalCommunaute::orderByDesc("created_at")->get());
       }else{
        
          return $response->message();
       }
       
    }

    public function bloquer(Communaute $communaute)
    {
    	
        //Authorisation
        $response = Gate::inspect('manage-users');
        if($response->allowed()){
             if($communaute->status=='ON'){
                 $communaute->status ="OFF";
                 $communaute->update(['status' => $communaute->status]);     
                 return response()->json(['success' => "Communauté bloquée avec succès !"]);
        }else{
           return response()->json(['success' => "Communauté déjà bloqué avec succès !"]);
        }
        }else{
            return $response->message();
        }

        
    }

    public function activer(Communaute $communaute)
    {
         //Authorisation
    	  $response = Gate::inspect('manage-users');

          if($response->allowed()){
              if($communaute->status=='OFF'){

                 $communaute->status ="ON";
                 $communaute->update(['status' => $communaute->status]);     

                 return response()->json(['success' => "Communauté activée avec succès !"]);
             }else{
                 return response()->json(['success' => "Communauté déjà activée avec succès !"]);
             }
             }else{
                 return $response->message();
          }
        
    }


    // supprimer

    public function supprimer(SignalCommunaute $signal)
    {
        //Authorisation
        $response = Gate::inspect('manage-users');
        if($response->allowed()){
           $signal->delete();
           return response()->json(['success' => "Signal supprimé avec succès !"]);
        }else{
            return $response->message();
        }

       
    }


     //supprimer post
    public function destroy(Communaute $communaute)
    {
        //Authorisation
         $response = Gate::inspect('manage-users');

        if($response->allowed()){

            $communaute->delete();
            return response()->json(['success' => "Communauté supprimée avec succès !"]); 

        }else{
              return $response->message();
        }
       
    }
  




}
