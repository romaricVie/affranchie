<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VersetUserRequest;
use App\Models\Prefere;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Verset;
use App\Http\Resources\VersetResource;

class VersetUserController extends Controller
{
    //




     public function verset()
     {
        
        // Verset du jour
        $verset = Verset::where('display_at',Carbon::today())->get();

        //6 Veserts des jours passés
        $versets = Verset::where('display_at','<',Carbon::today())->get();

        return response()->json([

                 "verset" => VersetResource::collection($verset),
                 "versets" => VersetResource::collection($versets),
        ]);
        
      
  

     }



    public function index()
    {
        
        $books = Book::all();

    	return response()->json([
    		 "books" => $books
    	]);


    }



     public function store(VersetUserRequest $request)
    {
    	$prefere = Prefere::create([

						              "book"=>$request->book,
                                "chapter"=>$request->chapter,
                                "verse"=>$request->verse,
                                "text"=>$request->text,
                                "user_id" => auth()->user()->id

						     ]);

    	if($prefere){
             return response()->json([
                                "success" => "Votre verset été bien enregistré !"
                ]);
         }else{
            return response()->json([
                        "error" => "Une erreur s'est produite, veuillez réessayer"
            ]);
         }
      

    }
}
