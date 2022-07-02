<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ville;
use Illuminate\Support\Facades\Gate;

class VilleDonAdminController extends Controller
{
    //
     public function index()
     {
        //
      $response = Gate::inspect('manage-users');

       if ($response->allowed()) {
      // The action is authorized...
        $villes = Ville::get();         
        return $villes;
      }else{

         echo $response->message();
    }

    }


    public function store(Request $request)
    {
        //

        //dd(request()->all());
      request()->validate([
        'name' => ['required','string','min:2'],
        'responsable' => ['required','string','min:2'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'phone' => ['required','string'],
      ]);
      
     //creer point relais
     Ville::create([
            'name'=> $request->name,
            'responsable' => $request->responsable,
            'email' => $request->email,
            'phone' => $request->phone
            ]);

       return response()->json([
                'success' => 'Point relais ajouté avec succès.'
       ]);
     
    }


     public function destroy(Ville $ville)
     {
        //
       
         //dd('delete');
       $response = Gate::inspect('manage-users');

       if ($response->allowed()) {
       // The action is authorized...
         $ville->delete();
         return response()->json([

                 'success' => 'Point relais supprimé avec succès!'
         ]);
      }else{

         echo $response->message();
      }   
    }





}
