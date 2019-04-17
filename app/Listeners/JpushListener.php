<?php

namespace App\Listeners;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use JPush\Client;

class JpushListener implements ShouldQueue
{
    /** @var \JPush\Client $client */
    private $client;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the event.
     *
     * @param \Illuminate\Notifications\DatabaseNotification $notification
     *
     * @return void
     */
    public function handle(DatabaseNotification $notification): void
    {
        if (app()->environment() === 'local') {
            return;
        }

        $user = $notification->notifiable;

        if (! $user->registration_id) {
            return;
        }

        // Jpush push message.
        $this->client
            ->push()
            ->setPlatform('all')
            ->addRegistrationId($user->registration_id)
            ->setNotificationAlert(strip_tags($notification->data['reply_content']))
            ->send();
    }
}
