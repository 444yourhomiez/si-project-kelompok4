<?php
namespace App\Providers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoApiTransport;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Mail::extend('brevo', function (array $config) {
            return new BrevoApiTransport($config['key'] ?? env('BREVO_KEY'));
        });
    }
}
