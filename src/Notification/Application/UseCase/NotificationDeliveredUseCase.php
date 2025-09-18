<?php

declare(strict_types=1);

namespace App\Notification\Application\UseCase;

use App\Notification\Api\Event\ResourceDelivered;
use Assert\Assertion;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

final readonly class NotificationDeliveredUseCase
{
    public function __construct(
        private MessageBusInterface $bus,

    )
    {
    }

    public function execute(string $reference): void
    {
        Assertion::uuid($reference);
        $this->bus->dispatch(new ResourceDelivered(Uuid::fromString($reference)));
    }
}
