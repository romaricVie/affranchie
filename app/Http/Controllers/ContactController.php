<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;


class ContactController extends Controller
{
    //

    public function store(ContactRequest $request)
    {
     
	$contact = Contact::create([
		        'name' => $request->name,
		        'firstname' =>$request->firstname,
		        'email' => $request->email,
		        'phone' => $request->phone,
		        'objet' => $request->objet,
		        'message' => $request->message,
		        'image'=> $this->storeImage(),
		    ]);
     
       if($contact){
             return response()->json([
                "succes" => "Votre message a été bien réçu! nous vous contacterons dès que possible."
             ]);
         }else{
            return response()->json([
               "erreur" => "erreur veuillez ressayer"
            ]);
         }

    }

     private function storeImage()
	  {
	     if(request('image'))
	      {  
	          return request()->file('image')->store('contact_image','public');
	      }

	      return null;
	    }

}
