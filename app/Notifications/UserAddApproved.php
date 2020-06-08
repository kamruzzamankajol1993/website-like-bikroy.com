<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserAddApproved extends Notification 
{
    use Queueable;

    public $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
   public function __construct($product)
    {
        $this->product = $product;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                     ->subject('Your Post Successfully Approved!')
                    ->greeting('Hello, ' .$this->product->user->name . ' !')
                    ->line('Your post has been successfully approved.')
                    ->line('Post Title : ' . $this->product->title)
                    ->action('View', url(route('user.product.show',$this->product->id)))
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
        ];
    }
}
