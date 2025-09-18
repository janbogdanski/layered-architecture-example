<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddinvoiceLine;

use App\Core\Domain\Model\InvoiceLine;

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
