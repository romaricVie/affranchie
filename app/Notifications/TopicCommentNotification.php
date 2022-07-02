<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Topic;

class TopicCommentNotification extends Notification
{
    use Queueable;
    public $user;
    public $topic;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Topic $topic)
    {
        //
          $this->user = $user;
          $this->topic = $topic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            "user_id" => $this->user->id,
            "id" => $this->topic->id,
            "text" => "a commente votre sujet",
            "name" => $this->user->name,
            "firstname" => $this->user->firstname,
            "profile_photo_path" => $this->user->profile_photo_path,
        ];
    }
}
