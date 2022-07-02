<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Don;


class DonAdminController extends Controller
{
    //
     public function index()
    {

       $response = Gate::inspect('super-admin');

       if($response->allowed()) {
      // The action is authorized...
        $dons = Don::whereStatus('ACTIF')
                         ->get();

         return $dons;
             

      }else{
         echo $response->message();
    }

    }


      public function enregistre()
	  {

	       $response = Gate::inspect('super-admin');

	       if($response->allowed()) {
	      // The action is authorized...
	        $dons = Don::whereStatus('INACTIF')
	                         ->get();
	         return $dons;
	             

	      }else{
	         echo $response->message();
	    }

     }

    public function edit(Don $don)
	  {

	       $response = Gate::inspect('super-admin');

	       if($response->allowed()) {
	      // The action is authorized...
	         return $don;
	             

	      }else{
	         echo $response->message();
	    }

     }



     public function update(Don $don)
    {
        //
      // dd('approuved');
        $response = Gate::inspect('super-admin');

       if ($response->allowed()) {
       // The action is authorized...

        if($don->status=='INACTIF'){

           $don->status ="ACTIF";
           $don->update(['status' => $don->status]);
         // Email Remerciement...
           
           /*$mailable = new DonReceived('Le departement social vous remercie pour vos dons, Que Dieu vous récompense abondamment.');
              Mail::to($don->email)
                  ->send($mailable);*/

         return response()->json([
               'success' => 'Don reçu avec succès!'
         ]);
        }else{
          return response()->json([
              'success' => 'Don déjà approuvé'
          ]);
        }
       
      
      }else{

         echo $response->message();
    }

    }


     public function destroy(Don $don)
     {
        //

       $response = Gate::inspect('manage-users');

       if ($response->allowed()) {
       // The action is authorized...
        $don->delete();

         return response()->json([
                   'success' => 'Dons supprimé avec succès!'
         ]);

         }else{

         echo $response->message();
      }   
    }




}
