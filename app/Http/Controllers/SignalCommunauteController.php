<?php

namespace App\Http\Controllers;

use App\Models\SignalCommunaute;
use App\Models\Communaute;
use Illuminate\Http\Request;
use App\Http\Resources\SignalCommunauteResource;

class SignalCommunauteController extends Controller
{
   
    public function store(Request $request, Communaute $communaute)
    {
        //
        $request->validate([ 
                          'message' => ['required','string','min:2'],
                          'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:102400'], //100MO
                          'communaute_id' => ['exists:communautes,id'],
                          'user_id' => ['exists:users,id'],
                          ]);

        $signal = SignalCommunaute::create([
                     'message'=> $request->message,
                     'image'=> $this->storeImage(),
                     'communaute_id'=> $communaute->id,
                     'user_id' => auth()->user()->id,
                   ]);

         if($signal){
                 return  response()->json([
                     "success" => "Message bien récu"
                 ]); 
          
         }else{
            return response()->json([
                "error" => "erreur du signal"
            ]);
         }



    }

   
   

    private function storeImage()
    {
      if(request('image'))
      {  
          return request()->file('image')->store('siganal_communaute_image','public');
      }

      return null;
    }
}
