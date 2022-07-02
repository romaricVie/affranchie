<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Mail; 
use App\Mail\NewUserCreated;

class UserController extends Controller
{
    /**
     * Register user.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // validate user infos
        
          $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:10'],
            'day' => ['required', 'string', 'max:2'],
            'month' => ['required', 'string', 'max:15'],
            'year' => ['required', 'string', 'max:4'],
            'phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            "password" => ['required','string','min:3','confirmed'],
       ]);

        //Create New user

          if($fields){

               $user = User::create([

                     'name' => $fields["name"],
                     'firstname'=> $fields["firstname"],
                     'sexe' => $fields['sexe'],
                     'day' => $fields['day'],
                     'month' => $fields['month'],
                     'year' => $fields['year'],
                     'phone' => $fields['phone'],
                     'email' => $fields['email'],
                     'password' => Hash::make($fields['password']),

      ]);

      //Create token
     $token = $user->createToken("MY_RESGISTER_TOKEN")->plainTextToken;

     //Attribution du role utilisateur... superAdministrateur utilisateur
     $role = Role::select('id')->where('name','utilisateur')->first();
     $user->roles()->attach($role);

     //Send email

     /* $mailable = new NewUserCreated($fields['name'],$fields['firstname'],"La communauté Affranchie vous souhaite la cordiale bienvenue. Que la grâce de notre Seigneur Jésus-Christ soit avec vous!");
        Mail::to($fields['email'])
                  ->send($mailable);*/
    
    //response 201 created
    
         return response()->json([
           "user" => $user,
           "token" => $token,
         ],201);

         // return response($response,201);
     }else{

           return response()->json([
                 "error" => "Donnees incorrects, veuillez ressayer!"
           ]);

          }
       
         

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // validation

        $fields = $request->validate([

             'email' => ['required', 'string', 'email'],
             'password' => ['required','string'],
        ]);

        //check user email
        $user = User::where('email', $fields['email'])->first();

        // check password
         if(!$user || !Hash::check($fields["password"], $user->password)){

                return response([
                 "message" => "Mot de passe ou e-mail incorrect!"
                ], 401);
      }
       //Create token
     $token = $user->createToken("MY_RESGISTER_TOKEN")->plainTextToken;
    
    //response

     /*$response = [

         "user" =>$user,
         "token" =>$token,

     ];
*/

     return response()->json([
                "user" => $user,
                "token" => $token
     ],200);
     // response($response,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       /* $user = User::find($id);

        return response()->json([

        "user"=> $user,

        ]);
*/
    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(auth()->user()->id == $user->id){

          return response()->json([
            "user" => $user
          ],200);

        }else{
         return response()->json([
                 "error" => "accès non autaurisé!"
                ], 401);

        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
         
         //Authorisation UserPolicy
         // recuperation user_id 
        // $user =User::find($user)
       // $user->id != auth()->user()->id
        if(auth()->user()->id == $user->id){

               //validate user infos
          $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'job' => ['nullable', 'string', 'max:255'],
            'religion' => ['nullable', 'string', 'max:255'],
            'conversion_date' => ['nullable', 'integer', 'max:2090'],
            'web' => ['nullable', 'url'],
            'bio' => ['nullable', 'string', 'max:255'],
             ]);


          if($fields){

                $user->update([
                   "name" => $request->name,
                   "firstname" => $request->firstname,
                   "country" => $request->country,
                   "city" => $request->city,
                   "job" => $request->job,
                   "religion" => $request->religion,
                   "conversion_date" => $request->conversion_date,
                   "web" => $request->web,
                   "bio" => $request->bio,
                ]);


      return response()->json([
                             // "user" => $user,
                              "success"=> "Mise à jour du profil éffectué avec succès"
                         ],200);

          }else{

            return response()->json([
                                 "error" => "Erreur de mise à jour"
                             ]);

          }

        }else{

          return response()->json([
                 "error" => "accès non autaurisé!"
                ], 401);

        }
        
        
    }

    public function photoUpdate(Request $request, User $user){

        //Authorisation
          if(auth()->user()->id == $user->id){
                $fields = $request->validate([
                          'profile_photo_path' => ['nullable', 'image', 'max:20240'],
                   ]);

          if($fields){

                 $path =  $request->file('profile_photo_path')->store('user_avatar','public');
                 $user->profile_photo_path  = $path;
                 $user->update();


            return response()->json([
                                   //  "user" => $user,
                                     "success"=> "Photo mise à jour avec succès!"
                                 ]);
          }else{
            return  response()->json([
                               "error" => "Erreur de mise à jour"
            ]);
          }

          }else{
              return response([
                 "error" => "accès non autaurisé!"
                ], 401);
          }

          
        

    }

        public function cover(Request $request, User $user){

        //Authorisation
          if(auth()->user()->id == $user->id){
                $fields = $request->validate([
                          'cover_photo_path' => ['nullable', 'image', 'max:20240'],
                   ]);

          if($fields){

                 $path =  $request->file('cover_photo_path')->store('cover','public');
                 $user->cover_photo_path  = $path;
                 $user->update();


            return response()->json([
                                     "user" => $user,
                                     "success"=> "Mise à jour photo de couverture éffectué avec succès!"
                                 ]);
          }else{
            return  response()->json([
                               "error" => "Erreur de mise à jour"
            ]);
          }

          }else{
              return response([
                 "error" => "accès non autaurisé!"
                ], 401);
          }

          
        

    }

  public function passwordUpdate(Request $request, User $user)
  {
     //authorisation 
    // validation auth()->user()->id
     if(auth()->user()->id == $user->id){
          $fields = $request->validate([

             'current_password' => ['required', 'string','current_password:users'],
             'password' => ['required','string','min:3','confirmed'],
        ]);

            //password verification
          if( !Hash::check($fields["current_password"], $user->password)){

                return response([
                 "message" => "Mot de passe est incorrect!"
                ], 401);
            }

          if($fields){
               $user->update([
                   "password" => Hash::make($fields['password'])
                ]);

               return response()->json([
                       "success" => "Votre mot de passe a été modifié avec succès!" 
               ]);

             }else{
                  return response()->json([
                       "error" => "Impossibe de modifier le mot de passe" 
               ]);
             }



     }else{
       return response()->json([
                 "error" => "accès non autaurisé!"
                ], 401);
     }

  }




     public function search($req)
     {

        if($req){

              $users = User::where('name','like','%'.$req.'%')
                                 ->orWhere('email','like','%'.$req.'%')
                                 ->orWhere('firstname','like','%'.$req.'%')
                                 ->orWhere('phone','like','%'.$req.'%')
                                 ->get();

                if(isset($users)){
                   return UserResource::collection($users);
                }else{
                  return response()->json([
                      "error" => "Aucun utilisateur pour la recherche"
                  ]);

                }

       } 

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        //

        auth()->user()->tokens()->delete();

       return response()->json([

        "message" => "logout"
  
       ],200);
    }

}
