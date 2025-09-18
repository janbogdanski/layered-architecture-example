<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Model\Employee\Employee;
use App\Domain\Model\Invoice;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Uid\Uuid;

final readonly class InvoiceRepository
{
    private ObjectRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        $this->repository = $entityManager->getRepository(Invoice::class);
    }

    public function save(Invoice $invoice): void
    {
        $this->entityManager->persist($invoice);
        $this->entityManager->flush();
    }

    public function find(Uuid $id): ?Invoice
    {
        return $this->repository->find($id);
    }

}
