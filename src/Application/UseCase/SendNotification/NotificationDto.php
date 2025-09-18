<?php

declare(strict_types=1);

namespace App\Application\UseCase\SendNotification;

use Symfony\Component\Uid\Uuid;

final readonly class NotificationDto
{
    public function __construct(
        public Uuid $resourceId,
        public string $toEmail,
        public string $subject,
        public string $message,
    ) {}
}
