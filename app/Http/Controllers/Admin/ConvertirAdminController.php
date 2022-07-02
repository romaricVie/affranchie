<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convertir;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ConvertirResource;


class ConvertirAdminController extends Controller
{
    //

    public function index(){

        $response = Gate::inspect('super-admin');

       if($response->allowed()) {
      // The action is authorized...
        $convertis = Convertir::latest()
                                ->get();
       return ConvertirResource::collection($convertis);
      }else{
         echo $response->message();
    } 
}
     
    public function show(Convertir $convertir)
    {
    	 
    	 $response = Gate::inspect('super-admin');

       if($response->allowed()) {
      // The action is authorized...
             return new ConvertirResource($convertir);
      }else{
         echo $response->message();
    }
    }
       

   

}
