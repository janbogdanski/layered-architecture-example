<?php

declare(strict_types=1);

namespace App\Notification\Api;

interface NotificationFacadeInterface
{
    public function notify(NotificationDto $message): void;
}
