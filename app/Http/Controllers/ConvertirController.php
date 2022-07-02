<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConvertirRequest;
use App\Models\Convertir;

class ConvertirController extends Controller
{
    //

    public function store(ConvertirRequest $request)
    {
    	$convertir = Convertir::create([

						        "pays"=>$request->pays,
						        "ville"=>$request->ville,
						        "habitation"=>$request->habitation,
						        "phone"=>$request->phone,
						        "email"=>$request->email,
						        "motivation"=>$request->motivation,
						        "image"=>$this->storeImage(),
						        "user_id"=>auth()->user()->id,

						     ]);

    	if($convertir){
             return response()->json([
                                "success" => "Vous serez contactés par le département des administrateurs."
                ]);
         }else{
            return response()->json([
                        "error" => "Une erreur s'est produite, veuillez réessayer"
            ]);
         }
      

    }

    private function storeImage()
    {
        return request()->file('image')->store('images_convertir','public');
    }


}
