<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
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
        $hashKey = Crypt::encrypt($notifiable->getKey());

        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', $this->verificationUrl($notifiable))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the verification URL for the given notifiable.
     * URL::temporarySignedRoute(
     *     ‘verificationapi.verify’, Carbon::now()->addMinutes(60), [‘id’ => $notifiable->getKey()]
     * );
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $prefix = config('grocers.frontend_url') . config('grocers.email_verify_url');
        $hashids = new Hashids('', 10);
       
        $temporarySignedURL = 'customerGID='.$hashids->encode($notifiable->getKey()).'&expired='.Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60))->timestamp.'&signatureGEV='.$hashids->encode(date("Ymd"));

        // I use urlencode to pass a link to my frontend.
        return $prefix.$temporarySignedURL;
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
