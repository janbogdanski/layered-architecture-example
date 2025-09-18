<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddInvoice;

use Assert\Assertion;

final readonly class AddInvoiceDto
{
    public function __construct(
        public string $customerName,
        public string $customerEmail,
    )
    {
        Assertion::email($this->customerEmail);
        Assertion::notEmpty($this->customerName);
    }

}
