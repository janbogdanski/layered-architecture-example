<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Persistence;

use App\Core\Domain\Model\Invoice;
use App\Domain\Model\Employee\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Uid\Uuid;

final class InMemoryInvoiceRepository implements InvoiceRepositoryInterface
{
    private array $data = [];


    public function save(Invoice $invoice): void
    {
        $this->data[(string)$invoice->id] = $invoice;
    }

    public function find(Uuid $id): ?Invoice
    {
        if (isset($this->data[(string) $id])) {
            return $this->data[(string) $id];
        }

        return null;
    }
}
