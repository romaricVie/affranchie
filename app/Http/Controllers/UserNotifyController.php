<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;

class UserNotifyController extends Controller
{
    //

   public function index(User $user)
   {

    	//$id = DatabaseNotification::all();
   //	$user = App\Models\User::find(1);

      //$id = DatabaseNotification::all();
      //return $id;
    /*foreach (auth()->user()->unreadNotifications as $notification) {
       return  $notification;
      }*/

    if(auth()->user()->id == $user->id ){

   	      return auth()->user()->unreadNotifications;

   	   }else{
   	   	 return  response()->json([
                   "error"  => " Accès non autorisé!"
   	   	 ]);
   	   }
       



   }


   public function markasred($id)
   {

    	//$id = DatabaseNotification::all();
     	//return $id;
   	   if($id){
   	      	return auth()->user()->notifications->where("id", $id)->markAsRead();
   	   }
       
       
   }
}
