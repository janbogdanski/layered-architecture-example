<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddinvoiceLine;

use App\Core\Infrastructure\Persistence\InvoiceRepository;
use Assert\Assertion;
use Symfony\Component\Uid\Uuid;

final readonly class AddInvoiceLineUseCase implements AddInvoiceLineUseCasePort
{
    public function __construct(
        private InvoiceRepository $invoiceRepository,
    )
    {
    }

    public function execute(Uuid $id, AddInvoiceLineDto $dto): void
    {
        Assertion::uuid($id, 'Invalid invoice id format');
        $invoice = $this->invoiceRepository->find($id);

        Assertion::notNull($invoice, 'Invoice not found');

        $invoiceLine = LineFactory::create($dto);

        $invoice->addLine($invoiceLine);
        $this->invoiceRepository->save($invoice);
    }

}
