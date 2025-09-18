<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddInvoice;

use App\Core\Domain\Model\Invoice;

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
