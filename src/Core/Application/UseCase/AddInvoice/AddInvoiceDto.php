<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddInvoice;

use Assert\Assertion;

final readonly class AddInvoiceDto
{
    public function __construct(
        public string $customerName,
        public string $customerEmail,
    )
    {
        Assertion::email($this->customerEmail, 'Invalid email');
        Assertion::notEmpty($this->customerName, 'Customer name is required');
    }

}
