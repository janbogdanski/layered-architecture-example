<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\SendNotification;


use App\Core\Infrastructure\Driver\DriverInterface;

final readonly class NotificationFacade implements NotificationFacadePort
{
    public function __construct(
        private DriverInterface $driver,

    )
    {
    }

    public function send(NotificationDto $message): void
    {
        $this->driver->send(
            toEmail: $message->toEmail,
            subject: $message->subject,
            message: $message->message,
            reference: $message->resourceId->toString(),
        );
    }

}
