<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'firstname','sexe','phone','day','month','year','email','city','country','job','religion','bio','web','conversion_date','password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     //Un utilisateur a un ou plusieurs topics;
    public function topics()
    {
        return $this->hasMany(Topic::class)->latest();
    }

      /**
     * Get all of the publication's comments.
     */
   /* public function commentaires()
    {
        return $this->morphMany(Commentaire::class, 'commentable');
    }*/

    // Un utilisateur a un et un seul verset prefere.
     public function prefere()
     {
        return $this->hasOne(Prefere::class)->latest();
     }

      // Un utilisateur se convertir une et une seule fois.
     public function convertir()
     {
        return $this->hasOne(Convertir::class)->latest();
     }


     //Un utilisateur a un ou plusieurs posts;
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }


    //Un utilisateur peut faire un ou plusieurs dons;
    public function dons()
    {
        return $this->hasMany(Don::class)->latest();
    }

     // Many to many
    //Un utilisateur peut interceder pour un ou plusieurs sujets;
    public function prieres()
    {
        return $this->belongsToMany(Priere::class);
    }

    //Roles

    //Many to Many
    // Un Utilisateur peut appartenir  à un ou plusieurs roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

   //Many to Many
    //Un user peut aimer un ou plusieurs postes
    public function likes()
    {
        return $this->belongsToMany(Post::class);
    }
     
     // Many to Many
    // Page pour communaute
    // Un user peut aimer un ou  plusieurs publications
    public function loves()
    {
        return $this->belongsToMany(Publication::class);
    }

    // Un user peut aimer un ou plusieurs topic
     public function aimes()
    {
       return $this->belongsToMany(Topic::class);
    }

      // Un Utilisateur  à une communautes
    public function communaute()
    {
        return $this->hasOne(Communaute::class)->latest();
    }

    //Un user a un ou plusieurs reponse;
    public function replys()
    {
        return $this->hasMany(Repondre::class);
    }


    //Un user a un ou plusieurs posts (affranchis) ;
    public function affranchis()
    {
        return $this->belongsToMany(Post::class, "affranchis","user_id","post_id");
    }

    // Page communaute
    // un Utilisateur a plusieurs plusieurs publications
   /* public function publications()
    {
        return $this->hasMany(Publication::class);
    }
*/
    //superAdministrateur 
    public function superAdmin()
    {

        return $this->roles()->where('name','superAdministrateur')->first();
    }

    //Select User role
    public function hasAnyRoles(array $roles)
    {
        return $this->roles()->whereIn('name',$roles)->first();
    }

     //Un user peut etre signalé un ou plusieurs fois
     public function signals()
     {
          return $this->hasMany(SignalUser::class);
     }


     public function sendPasswordResetNotification($token)
    {

        $url = 'http://127.0.0.1:8000/api/reset-link?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }





    
}
