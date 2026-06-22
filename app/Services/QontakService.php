<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class QontakService
{
    private string $baseUrl = 'https://service-chat.qontak.com/api/open/v1';

    private function getAccessToken(): string
    {
        return Cache::remember('qontak_access_token', 3500, function () {
            $response = Http::post("{$this->baseUrl}/auth/token", [
                'username'      => config('services.qontak.username'),
                'password'      => config('services.qontak.password'),
                'grant_type'    => 'password',
                'client_id'     => config('services.qontak.client_id'),
                'client_secret' => config('services.qontak.client_secret'),
            ]);

            if (! $response->successful()) {
                throw new \RuntimeException('Gagal autentikasi ke Qontak: ' . $response->body());
            }

            return $response->json('access_token');
        });
    }

    public function sendWhatsAppOtp(string $phone, string $otp, string $name = 'Pengguna'): void
    {
        // Konversi 08xxx ke 628xxx
        $phone = preg_replace('/^0/', '62', $phone);

        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/broadcasts/whatsapp/direct", [
                'to_name'                => $name,
                'to_number'              => $phone,
                'message_template_id'    => config('services.qontak.template_id'),
                'channel_integration_id' => config('services.qontak.channel_id'),
                'language'               => ['code' => 'id'],
                'parameters'             => [
                    'body' => [
                        [
                            'key'        => '1',
                            'value_text' => $otp,
                            'value'      => 'otp_code',
                        ],
                    ],
                ],
            ]);

        if (! $response->successful()) {
            // Invalidate token cache jika unauthorized, supaya di-refresh saat berikutnya
            if ($response->status() === 401) {
                Cache::forget('qontak_access_token');
            }
            throw new \RuntimeException('Gagal mengirim WhatsApp OTP: ' . $response->body());
        }
    }
}
