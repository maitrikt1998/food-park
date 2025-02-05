<?php

namespace App\Listeners;

use App\Events\RTOorderPlacedNotificationEvent;
use App\Models\OrderPlacedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RTOorderPlacedNotificationListener
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
    public function handle(RTOorderPlacedNotificationEvent $event): void
    {
        $notification  = new OrderPlacedNotification();
        $notification->message = $event->message;
        $notification->order_id = $event->orderId;
        $notification->save();
    }
}
