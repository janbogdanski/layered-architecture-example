<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\SendNotification;

interface NotificationFacadePort
{
    public function send(NotificationDto $message): void;

}
