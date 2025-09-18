<?php

declare(strict_types=1);

namespace App\Core\Application\View;

use App\Core\Domain\Model\Status;
use JsonSerializable;
use Symfony\Component\Uid\Uuid;

final readonly class GetInvoiceView implements JsonSerializable
{
    public function __construct(
        public Uuid $id,
        private Status $status,
        private string $customerName,
        private string $customerEmail,
        private int $total,
        /** @var GetInvoiceLineView[] */
        private array $lines,
    ) {

    }

    public function jsonSerialize(): array
    {
        return [
            'id' => (string)$this->id,
            'status' => $this->status->value,
            'customerName' => $this->customerName,
            'customerEmail' => $this->customerEmail,
            'totalUnitPrice' => $this->total,
            'lines' => $this->lines,
        ];
    }
}