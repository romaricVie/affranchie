<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Contact;


class ContactAdminController extends Controller
{
    //
      public function index()
    {
    	 $response = Gate::inspect('gestion-utilisateur');

       if($response->allowed()) {
      // The action is authorized...
        $contacts = Contact::latest()->get();

        
        return $contacts;

      }else{
         echo $response->message();
    }


    }


    public function show(Contact $contact)
    {
    	 $response = Gate::inspect('gestion-utilisateur');

       if($response->allowed()) {
      // The action is authorized...
       
        return $contact;
      }else{
         echo $response->message();
    }
}

 public function destroy(Contact $contact)
    {
        //
    
      $response = Gate::inspect('gestion-utilisateur');

       if ($response->allowed()) {
       // The action is authorized...
        $contact->delete();
        
         return response()->json([
               "success" => "Message supprimé avec succès!"
         ]);
      }else{

         echo $response->message();
      }   
    }






}
