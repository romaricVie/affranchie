<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DonRequest;
use App\Models\Don;
use App\Models\Ville;

class Doncontroller extends Controller
{
    //

    public function index()
    {
    	$villes = Ville::all();

    	return response()->json([
    		 "villes" => $villes
    	]);
    }


    public function store(DonRequest $request)
    {
      
     $don =  Don::create([
				        'name' => $request->name,
				        'firstname' =>$request->firstname,
				        'email' => $request->email,
				        'phone' => $request->phone,
				        'nom_produit' => $request->nom_produit,
				        'description' => $request->description,
				        'type' => $request->type,
				        'etat_don' => $request->etat_don,
				        'point_relais' => $request->point_relais,
				        'status' => "INACTIF",
				        'images' => $this->storImage(),
				    ]);
       if($don){
             return response()->json([
                                "don" => "Votre don à été enrégistré avec succès"
                ]);
         }else{
            return response()->json([
                        "erreur" => "erreur s'est produite, veuillez réessayer svp!"
            ]);
         }
    }

    private function storImage()
    {
        return request()->file('images')->store('images_don','public');
    }
}
