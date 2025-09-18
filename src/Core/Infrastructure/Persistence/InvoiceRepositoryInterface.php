<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Persistence;


use App\Core\Domain\Model\Invoice;
use Symfony\Component\Uid\Uuid;

interface InvoiceRepositoryInterface
{
    public function save(Invoice $invoice): void;

    public function find(Uuid $id): ?Invoice;

}
