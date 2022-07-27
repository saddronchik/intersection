<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Users extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct(string $text)
    // {
    //     $this->text = $text;
    // }

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
    public function send($notifiable, Notification $notification)
    {
      $data = $notification->toDatabase($notifiable);
  
      return $notifiable->routeNotificationFor('database')->create([
          'id' => $notification->id,
  
          //customize here
          'answer_id' => $data['answer_id'], //<-- comes from toDatabase() Method below
          'user_id'=> Auth::user()->id,
  
          'type' => get_class($notification),
          'data' => $data,
          'read_at' => null,
      ]);
    }
    public function toDashboard($notifiable){
       

    }

    // public function userMessage($user ){
        
    //         $id_user = Auth::user()->username;
   
    //     dd($user, $id_user);
    // }

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

        ];
    }
}
