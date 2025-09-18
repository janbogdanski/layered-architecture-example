<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddinvoiceLine;

final readonly class AddInvoiceLineDto
{
    public function __construct(
        public string $productName,
        public int $unitPrice,
        public int $quantity,
    )
    {
    }

}
