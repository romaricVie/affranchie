<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CommunauteController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SignalCommunauteController;
use App\Http\Controllers\SignalPostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Doncontroller;
use App\Http\Controllers\PriereController;
use App\Http\Controllers\ConvertirController;
use App\Http\Controllers\VersetUserController;
use App\Http\Controllers\EnseignementController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\AffranchiController;
use App\Http\Controllers\UserNotifyController;

/* Admin */
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\CommunauteAdminController;
use App\Http\Controllers\Admin\VilleDonAdminController;
use App\Http\Controllers\Admin\DonAdminController;
use App\Http\Controllers\Admin\ConvertirAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Code on git hub

//Public routes
Route::post("register",[UserController::class,'register']);
Route::post("login",[UserController::class,'login']);

/*  Contact  ContactController*/
Route::post('contact',[ContactController::class, 'store']);

  /* Donation Doncontroller */
Route::post('donation',[Doncontroller::class, 'store']);
Route::get('point-relais',[Doncontroller::class, 'index']);




//Protected routes
Route::middleware('auth:sanctum')->group(function () {
  Route::post("logout",[UserController::class,'logout']);
  Route::get("users/{user}/edit",[UserController::class,'edit']);
  Route::patch("users/{user}",[UserController::class,'update']);
  Route::post("photos/{user}",[UserController::class,'photoUpdate']);
  Route::post("cover/{user}",[UserController::class,'cover']); //new
  Route::patch("update-password/{user}",[UserController::class,'passwordUpdate']);

  /* Post  publication */
  Route::post("posts",[PostController::class,'store']);
  Route::get("posts",[PostController::class,'index']);
  Route::get("posts/{id}",[PostController::class,'show']);
  Route::get("posts/{id}/edit",[PostController::class,'edit']);
  Route::post("posts/{id}",[PostController::class,'update']);
  Route::delete("posts/{id}",[PostController::class,'destroy']);

 
  /* Temoignage */
   Route::post("temoignages",[TemoignageController::class,'store']);
   Route::get("temoignages",[TemoignageController::class,'index']);


   /* Evenement */
   Route::post("evenements",[EvenementController::class,'store']);
   Route::get("evenements",[EvenementController::class,'index']);
  

   /* Enseignement */
    Route::post("enseignements",[EnseignementController::class,'store']);
    Route::get("enseignements",[EnseignementController::class,'index']);


    /*  Like post addLike  */
    Route::post("like-posts/{id}",[PostController::class,'addLike']);

   /*Commentaire post PostCommentController */
    Route::post("posts/{id}/comment",[PostCommentController::class, 'store']);
   // Route::delete("comments/{id}",[PostCommentController::class,'destroy']);
    

   /* Topic TopicController */
   Route::post("forums",[TopicController::class,'store']);
   Route::get("forums",[TopicController::class,'index']);
   Route::get("forums/{id}",[TopicController::class,'show']);
   Route::get("forums/{id}/edit",[TopicController::class,'edit']);
   Route::patch("forums/{id}",[TopicController::class,'update']);
   Route::delete("forums/{id}",[TopicController::class,'destroy']);


  /* like forum */

  Route::post("like-forums/{id}",[TopicController::class,'addLike']);


   /* Comment topic  */
    Route::post("forums/{id}/comment",[CommentController::class,'store']);
    Route::delete("comments/{id}",[CommentController::class,'destroy']);

   /*  Communaute pages CommunauteController */
    
    Route::post("communautes",[CommunauteController::class,'store']);
    Route::get("communautes",[CommunauteController::class,'index']);
    Route::get("communautes/{id}",[CommunauteController::class,'show']);
    Route::get("communautes/{id}/edit",[CommunauteController::class,'edit']);
    Route::post("communautes/{id}",[CommunauteController::class,'update']);
    Route::delete("communautes/{id}",[CommunauteController::class,'destroy']);


    /* Publication de communaute  PublicationController*/
    
    Route::post("communautes/{id}/publication",[PublicationController::class,'store']);
    //Route::get("publication",[PublicationController::class,'index']);
    Route::get("publications/{id}",[PublicationController::class,'show']);
    Route::get("publications/{id}/edit",[PublicationController::class,'edit']);
    Route::patch("publications/{id}",[PublicationController::class,'update']);
    Route::delete("publications/{id}",[PublicationController::class,'destroy']);

    /* Commentaire communaute CommentaireController   */

     Route::post("publications/{id}/comment",[CommentaireController::class,'store']);
     

     // delete comments 
     Route::delete("comments/{id}",[CommentaireController::class,'destroy']);


    /* like publication  1340  */

     Route::post("like-publications/{id}",[PublicationController::class,'addLike']);


     /* Reply ReplyController*/

    Route::post("comments/{id}/reply",[ReplyController::class,'store']);


    /* Signet AffranchiController */
     Route::post("posts/{id}/signet",[AffranchiController::class,'store']);
     Route::get("users/{id}/signet",[AffranchiController::class,'index']);
     
     
    /* SignalCommunauteController Communaute SignalCommunauteController*/
     Route::post('signal-communaute/{communaute}', [SignalCommunauteController::class, 'store']);

      
     /* SignalPostController Communaute*/
     Route::post('signal-post/{post}', [SignalPostController::class, 'store']);
   
     /* SignalGroupecontroller Communaute*/



     /*   Prière  PriereController  */
     Route::post('priere',[PriereController::class, 'store']);
     Route::get('prieres',[PriereController::class, 'index']);
     Route::delete('prieres/{id}',[PriereController::class, 'destroy']);
     Route::get('prieres/{id}',[PriereController::class, 'show']);
     Route::post('je-prie/{id}',[PriereController::class, 'prie']);
    
    /*  Convertir ConvertirController  */

    Route::post('convertir', [ConvertirController::class, 'store']);
  
  /* Verset Prefere VersetUserController */
   Route::post('verset-prefere',[VersetUserController::class, 'store']);
   Route::get('prefere',[VersetUserController::class, 'index']);
   Route::get('verset-du-jour',[VersetUserController::class, 'verset']);


  /* User profil ProfilController */
   Route::get('profil/{id}',[ProfilController::class, 'index']);
   Route::post('user-signal/{user}',[ProfilController::class, 'store']);


   /* search user*/
    Route::get("users/search/{req}",[UserController::class,'search']);
   /* search communauty*/
    Route::get("communautes/search/{req}",[CommunauteController::class,'search']);
   /* search topic */
    Route::get("forums/search/{req}",[TopicController::class,'search']);

  /* search post */
   Route::get("posts/search/{req}",[PostController::class,'search']);
   
  // Route::post("forums/search",[TopicController::class,'test']);


  // Notifications d42d5602-836b-465b-bfe8-27105fe2ea4c
  Route::get("notifications/{user}",[UserNotifyController::class,'index']);
  Route::get("notifications-read/{id}",[UserNotifyController::class,'markasred']);

  /* Administration UserAdminController */

  Route::get("admin/users",[UserAdminController::class,'index']);
  Route::get("admin/users/{user}",[UserAdminController::class,'show']);
  Route::patch("admin/users/{user}",[UserAdminController::class,'update']);
  Route::get("admin/users/{user}/edit",[UserAdminController::class,'edit']);
  Route::delete("admin/users/{user}",[UserAdminController::class,'destroy']);
  Route::get("admin/dashboard",[UserAdminController::class,'dashboard']);
  Route::get("admin/signal-user",[UserAdminController::class,'signaler']);
  Route::delete("admin/signal-user/{signal}",[UserAdminController::class,'supprimer']);
  
   // Post gestion
  Route::get("admin/signal-posts",[PostAdminController::class,'index']);
  Route::patch('admin/bloquer-posts/{post}', [PostAdminController::class, 'bloquer']);
  Route::patch('admin/debloquer-posts/{post}', [PostAdminController::class, 'activer']);
  Route::delete('admin/delete-posts/{post}', [PostAdminController::class, 'destroy']);
  Route::delete('admin/signal/{signal}', [PostAdminController::class, 'supprimer']);

 
  //Communauté gestion CommunauteAdminController
   Route::get("admin/signal-communautes",[CommunauteAdminController::class,'index']);
   Route::patch('admin/bloquer-communautes/{communaute}', [CommunauteAdminController::class, 'bloquer']);
   Route::patch('admin/debloquer-communautes/{communaute}', [CommunauteAdminController::class, 'activer']);
   Route::delete('admin/delete-communautes/{communaute}', [CommunauteAdminController::class, 'destroy']);
   Route::delete('admin/delete-signals/{signal}', [CommunauteAdminController::class, 'supprimer']);


   // Point relais VilleDonAdminController
  Route::get("admin/point-relais",[VilleDonAdminController::class,'index']);
  Route::post("admin/point-relais",[VilleDonAdminController::class,'store']);
  Route::delete("admin/point-relais/{ville}",[VilleDonAdminController::class,'destroy']);


  //Don
  Route::get("admin/dons/recu",[DonAdminController::class,'index']);
  Route::get("admin/dons/enregistre",[DonAdminController::class,'enregistre']);
  Route::get('admin/dons/{don}/edit', [DonAdminController::class,'edit']);
  Route::patch('admin/dons/{don}', [DonAdminController::class,'update']);
  Route::delete('admin/dons/{don}', [DonAdminController::class,'destroy']);

  //Nouveaux convertir 
  Route::get("admin/nouveaux-convertis",[ConvertirAdminController::class,'index']);
  Route::get("admin/convertir/{convertir}",[ConvertirAdminController::class,'show']);

  //Contact
  
     /******************************* Contact Admin ContactAdminController ***********************/
    Route::get('admin/contacts', [ContactAdminController::class,'index']);
    Route::get('admin/contacts/{contact}', [ContactAdminController::class,'show']);
    Route::delete('admin/contacts/{contact}', [ContactAdminController::class,'destroy']);

});


