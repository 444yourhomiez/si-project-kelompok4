<?php
namespace App\Notifications;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailOtpNotification extends Notification
{
    public function __construct(private string $otp) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode Verifikasi Email - Koperasi Motekar')
            ->greeting('Halo!')
            ->line('Terima kasih telah mendaftar di **Koperasi Motekar**.')
            ->line('Gunakan kode OTP berikut untuk memverifikasi alamat email Anda:')
            ->line('---')
            ->line('## ' . $this->otp)
            ->line('---')
            ->line('Kode ini berlaku selama **10 menit** sejak email ini dikirim.')
            ->line('Demi keamanan, jangan bagikan kode ini kepada siapapun.')
            ->line('Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.')
            ->salutation('Salam, Tim Koperasi Motekar');
    }
}
