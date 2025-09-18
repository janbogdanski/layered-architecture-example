<?php

declare(strict_types=1);

namespace App\Notification\Infrastructure\Driver;


interface DriverInterface
{
    public function send(
        string $toEmail,
        string $subject,
        string $message,
        string $reference,
    ): bool;
}
