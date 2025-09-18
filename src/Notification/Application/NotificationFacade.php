<?php

declare(strict_types=1);

namespace App\Notification\Application;


use App\Core\Application\UseCase\SendNotification\NotificationFacadePort;
use App\Notification\Api\NotificationDto;
use App\Notification\Api\NotificationFacadeInterface;
use App\Notification\Infrastructure\Driver\DriverInterface;

final readonly class NotificationFacade implements NotificationFacadeInterface
{
    public function __construct(
        private DriverInterface $driver,
    )
    {
    }

    public function notify(NotificationDto $message): void
    {
        $this->driver->send(
            toEmail: $message->toEmail,
            subject: $message->subject,
            message: $message->message,
            reference: $message->resourceId->toString(),
        );
    }

}
