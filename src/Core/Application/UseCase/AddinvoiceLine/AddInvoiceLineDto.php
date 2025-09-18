<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddinvoiceLine;

use Assert\Assertion;

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
