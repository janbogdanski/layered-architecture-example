<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddInvoice;

use App\Domain\Model\Invoice;

final readonly class InvoiceFactory
{
    public static function create(AddInvoiceDto $dto): Invoice
    {
        return new Invoice(
            $dto->customerName,
            $dto->customerEmail,
        );

    }
}
