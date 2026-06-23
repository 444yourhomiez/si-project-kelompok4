<?php
namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public function __construct(public string $token) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password - Koperasi Motekar')
            ->greeting('Halo!')
            ->line('Kami menerima permintaan reset password untuk akun Anda di **Koperasi Motekar**.')
            ->line('Klik tombol di bawah ini untuk membuat password baru:')
            ->action('Reset Password', $url)
            ->line('Link ini hanya berlaku selama **3 menit**.')
            ->line('Jika Anda tidak merasa meminta reset password, abaikan email ini. Password Anda tidak akan berubah.')
            ->salutation('Salam, Tim Koperasi Motekar');
    }
}
