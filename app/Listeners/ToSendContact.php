<?php

namespace App\Listeners;

use App\Events\EmailContact;
use App\Mail\ContactSiteMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

use function Symfony\Component\Clock\now;

class ToSendContact implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailContact $event): void
    {
        // Disparar o e-mail
        // O destinatário pode ser fixo (o teu email) ou dinâmico
        Mail::to($event->contact->email)
            ->later(Carbon::now()->addSeconds(3), new ContactSiteMail($event->contact, $event->about, $event->medias));
    }
}
