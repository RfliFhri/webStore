<?php

namespace App\Listeners;

use App\Events\SalesOrderSuccessedEvent;
use App\Mail\SalesOrderSuccessedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SalesOrderSuccessedListener
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
    public function handle(SalesOrderSuccessedEvent $event): void
    {
        Mail::queue(
            new SalesOrderSuccessedMail($event->sales_order)
        );
    }
}
