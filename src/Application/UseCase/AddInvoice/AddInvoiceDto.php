<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddInvoice;

final readonly class AddInvoiceDto
{
    public function __construct(
        public string $customerName,
        public string $customerEmail,
    )
    {
    }

}
