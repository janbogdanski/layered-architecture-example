<?php

declare(strict_types=1);

namespace App\Application\View;

use JsonSerializable;
use Symfony\Component\Uid\Uuid;

final readonly class GetInvoiceView implements JsonSerializable
{
    public function __construct(
        public Uuid $id,
    ) {

    }

    public function jsonSerialize(): array
    {
        return [
            'id' => (string)$this->id,
        ];
    }
}