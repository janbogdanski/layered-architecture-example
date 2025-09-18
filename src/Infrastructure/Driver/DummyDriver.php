<?php

declare(strict_types=1);

namespace App\Infrastructure\Driver;

class DummyDriver implements DriverInterface
{
    public function send(
        string $toEmail,
        string $subject,
        string $message,
        string $reference,
    ): bool {
        return true;
    }
}
