<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Passwort zurücksetzen - ' . config('app.name'))
            ->line('Sie haben einen Link zum ändern Ihrer Zugangsdaten angefordert. Klicken Sie dafür auf folgenden Link:')
            ->action('Hier klicken, um Passwort zurückzusetzen', url('password/reset', $this->token))
            ->line('Der Link wird in 60 Minuten ungültig.')
            ->line('Diese E-Mail wurde automatisch generiert. Antworten ist zwecklos...')
             ->line('Sollten Sie das Zurücksetzen Ihrer Zugangsdaten nicht angefordert haben, betrachen Sie diese E-Mail bitte als gegenstandslos!');
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
