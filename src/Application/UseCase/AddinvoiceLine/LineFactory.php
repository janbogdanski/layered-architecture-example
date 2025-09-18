<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddinvoiceLine;

use App\Domain\Model\InvoiceLine;

final readonly class LineFactory
{
    public static function create(AddInvoiceLineDto $dto): InvoiceLine
    {
        return new InvoiceLine(
            $dto->productName,
            $dto->quantity,
            $dto->unitPrice,
        );

}
}
