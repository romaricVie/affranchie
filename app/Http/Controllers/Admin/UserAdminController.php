<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Communaute;
use App\Models\Don;
use App\Models\Priere;
use App\Models\Contact;
use App\Models\Convertir;
use App\Models\SignalUser;
use Illuminate\Http\Request;
use App\Http\Resources\AdminUserResource;
use App\Http\Resources\SignalUserResource;
use Illuminate\Support\Facades\Gate;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //alls users;
         //Authorisation
         $response = Gate::inspect('gestion-utilisateur');
         if($response->allowed()){

            return AdminUserResource::collection(User::orderByDesc("created_at")->get());
         }else{
            return $response->message();
         }
    }

    public function dashboard()
    {
         $response = Gate::inspect('super-admin');
         if ($response->allowed()){

                 $users = User::get('id')->count();

                 $pages = Communaute::get('id')->count();

                 $posts = Post::whereStatus("INACTIF")
                                ->get('id')
                                ->count();

                 $don_recus = Don::whereStatus('ACTIF')
                                 ->get('id')
                                 ->count();

                 $don_enregistres = Don::whereStatus('INACTIF')
                                 ->get('id')
                                 ->count();

                 $messages = Contact::get('id')
                                     ->count();
                  // Prière
                // $prieres = Priere::get('id');
                  //convertis
                 $convertis = Convertir::get('id')->count();




                
                return response()->json([
                      
                       "users" => $users,
                       "pages" => $pages,
                       "posts_bloques" => $posts,
                       "messages" => $messages,
                       "convertis" => $convertis,
                       "don_recus" => $don_recus,
                       "don_enregistres" => $don_enregistres,

                ]);

       }else{

           return $response->message();
       }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
     //   return new AdminUserResource($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
          $response = Gate::inspect('gestion-utilisateur');

          if($response->allowed()){
                return new AdminUserResource($user);
          }else{
           
           return $response->message();
          }
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Authorisation
         $response = Gate::inspect('gestion-utilisateur');

         if($response->allowed()){
               $user->roles()->sync($request->roles);
               $user->save();
        // return new AdminUserResource($user);
              return response()->json([
               'success' => "Role modifié avac succès!"
               ]);
            }else{
                return $response->message();

         }
        


    }

    public function signaler()
    {
        // $signals = SignalUser::get();

        // return $signals;*/
          $response = Gate::inspect('gestion-utilisateur');
          
         if($response->allowed()){
              return SignalUserResource::collection(SignalUser::orderByDesc("created_at")->get());
         }else{
            return $response->message();
         }
       
    }

     // supprimer

    public function supprimer(SignalUser $signal)
    {
        //Authorisation
         $response = Gate::inspect('manage-users');
         if($response->allowed()){
              $signal->delete();
              return response()->json(['success' => "Signal supprimer avec succès !"]);
         }else{
             return $response->message();
         }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Authorisation
        $response = Gate::inspect('gestion-utilisateur');
        
        if($response->allowed()){

            $user->roles()->detach();
            $user->delete();
          return response()->json([
                     "success" => "Utilisateur a été banni avec succès!"
              ]);

        }else{
            
            return $response->message();
        }

        
    }
}
