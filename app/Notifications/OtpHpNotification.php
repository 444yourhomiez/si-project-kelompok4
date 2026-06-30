<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpHpNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $otp,
        public string $noHp
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode OTP Verifikasi Nomor HP - Koperasi Motekar')
            ->greeting('Halo!')
            ->line('Kami menerima permintaan verifikasi untuk nomor HP **' . $this->noHp . '** yang didaftarkan di **Koperasi Motekar**.')
            ->line('Gunakan kode OTP berikut untuk melanjutkan proses verifikasi:')
            ->line('---')
            ->line('## ' . $this->otp)
            ->line('---')
            ->line('Kode ini berlaku selama **10 menit** sejak email ini dikirim.')
            ->line('Demi keamanan, jangan bagikan kode ini kepada siapapun.')
            ->line('Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini.')
            ->salutation('Salam, Tim Koperasi Motekar');
    }
}
