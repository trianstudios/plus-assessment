<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyUserOfLogin extends Notification
{
    use Queueable;

    /**
     * @var array
     */
    private $location;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(String $location)
    {
        $this->location = $location;
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
            ->subject("A new device/browser has been detected")
            ->greeting('Hello ' . auth()->user()->name)
            ->line("A login from a new device/browser has been detected: {$this->location}. If this is a mistake then please change your password immediately.")
            ->action('Reset Password', route('password.request'));
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
