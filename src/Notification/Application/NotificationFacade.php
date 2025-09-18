<?php

declare(strict_types=1);

namespace App\Notification\Application;


use App\Core\Application\UseCase\SendNotification\NotificationFacadePort;
use App\Notification\Api\NotificationDto;
use App\Notification\Api\NotificationFacadeInterface;
use App\Notification\Infrastructure\Driver\DriverInterface;
use Assert\Assertion;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class NotificationFacade implements NotificationFacadeInterface
{
    public function __construct(
        private DriverInterface $driver,
        private HttpClientInterface $client,

    )
    {
    }

    public function notify(NotificationDto $message): void
    {
        $result = $this->driver->send(
            toEmail: $message->toEmail,
            subject: $message->subject,
            message: $message->message,
            reference: $message->resourceId->toString(),
        );
        if (!$result) {
            throw new \RuntimeException('Failed to send notification');
        }

        $this->client->request('GET', "http://nginx/notification/hook/delivered/$message->resourceId");
    }

}
