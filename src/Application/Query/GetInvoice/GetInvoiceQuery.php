<?php

declare(strict_types=1);

namespace App\Application\Query\GetInvoice;

use App\Application\View\GetInvoiceView;
use App\Infrastructure\Persistence\InvoiceRepository;
use Assert\Assertion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

final readonly class GetInvoiceQuery implements GetInvoiceQueryPort
{
    public function __construct(
        private InvoiceRepository $invoiceRepository,
    )
    {
    }

    public function execute(string $id): GetInvoiceView
    {

        Assertion::uuid($id);

        $invoice = $this->invoiceRepository->find($id);


        return new GetInvoiceView(id: $invoice->id);
    }
}