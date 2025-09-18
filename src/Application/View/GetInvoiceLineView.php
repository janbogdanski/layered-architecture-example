<?php

declare(strict_types=1);

namespace App\Application\View;

use App\Domain\Model\InvoiceLine;
use App\Domain\Model\Status;
use JsonSerializable;
use Symfony\Component\Uid\Uuid;

final readonly class GetInvoiceLineView implements JsonSerializable
{
    public function __construct(
        private string $productName,
        private int    $quantity,
        private int    $unitPrice,
        private int    $totalUnitPrice,
    )
    {

    }

    public function jsonSerialize(): array
    {
        return [
            'productName' => $this->productName,
            'quantity' => $this->quantity,
            'unitPrice' => $this->unitPrice,
            'totalUnitPrice' => $this->totalUnitPrice,
        ];
    }
}