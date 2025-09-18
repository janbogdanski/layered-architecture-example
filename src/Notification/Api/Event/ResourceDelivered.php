<?php

declare(strict_types=1);

namespace App\Notification\Api\Event;

use Symfony\Component\Uid\Uuid;

final readonly class ResourceDelivered
{
    public function __construct(
        public Uuid $resourceId,
    )
    {
    }
}
