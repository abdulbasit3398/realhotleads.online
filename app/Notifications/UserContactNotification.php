<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserContactNotification extends Notification
{
    use Queueable;

    private $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
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
                ->subject('Contact Request Notification')
                ->greeting('Hello!')
                ->line('One of your contact request has update!')
                ->line($this->contact->search_key.' '.$this->contact->key_word.' '.$this->contact->mobile_b2b)
                ->line($this->contact->notes)
                // ->action('View Invoice', $this->contact->notes)
                ->line('Note: You can only access file within 24 hours')
                ->line('Thank you for using our application!');
        // return (new MailMessage)->view(
        //     'emails.user_contact', ['contact' => $this->contact]
        // );

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
