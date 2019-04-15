<?php

namespace App\Http\Controllers\Api;

use App\Transformers\NotificationTransformer;
use Dingo\Api\Http\Response;

class NotificationsController extends ApiController
{
    public function index(): Response
    {
        $notifications = $this->user->notifications()->paginate(20);

        return $this->response->paginator($notifications, new NotificationTransformer());
    }

    public function stats(): Response
    {
        return $this->response->array([
            'unread_count' => $this->user()->notification_count,
        ]);
    }
}
