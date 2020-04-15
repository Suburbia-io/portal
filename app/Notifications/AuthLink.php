<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthLink extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        if (!$notifiable instanceof User) {
            throw new \InvalidArgumentException("Can only send auth link to users.");
        }

        // Set the users login nonce to make sure this link can only be used once
        $nonce = Str::random(64);
        $notifiable->setLoginNonce($nonce);
        $notifiable->save();

        // Generate a signed URL, valid for 1 hour
        $authLink = URL::temporarySignedRoute(
            'auth.login', now()->addHour(), [
                'user' => $notifiable->getAuthIdentifier(),
                'nonce' => $nonce,
            ]
        );

        return (new MailMessage)
            ->line('Hello! Please click the link below to sign in to Suburbia')
            ->action('Sign in to Suburbia', $authLink)
            ->line('This link is valid for one hour and can only be used once.');
    }

}
