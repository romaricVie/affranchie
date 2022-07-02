<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;



class NewUserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $firstname;
    public $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$firstname,$text)
    {
        //
         $this->name = $name;
         $this->firstname = $firstname;
         $this->text = $text;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("info@affranchie.com")  // l'expediteur
                    ->subject("Bienvenue sur affranchie!")    
                    ->markdown('emails.messages.newUserMessage');
    }
}
