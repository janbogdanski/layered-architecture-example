<?php

declare(strict_types=1);

namespace App\Core\Domain\Event;

use Symfony\Component\Uid\Uuid;

final readonly class InvoiceSent
{
    public function __construct(
        public Uuid $invoiceId
    )
    {
    }

}
