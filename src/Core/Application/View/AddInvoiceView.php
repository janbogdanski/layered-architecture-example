<?php

declare(strict_types=1);

namespace App\Core\Application\View;

use Symfony\Component\Uid\Uuid;

final readonly class AddInvoiceView implements \JsonSerializable
{
    public function __construct(
        public Uuid $id,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => (string)$this->id,
        ];
    }
}
