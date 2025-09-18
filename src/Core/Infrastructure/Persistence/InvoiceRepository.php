<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Persistence;

use App\Core\Domain\Model\Invoice;
use App\Domain\Model\Employee\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Uid\Uuid;

final readonly class InvoiceRepository implements InvoiceRepositoryInterface

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
