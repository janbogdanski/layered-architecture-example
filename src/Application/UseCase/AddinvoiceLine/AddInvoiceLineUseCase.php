<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddinvoiceLine;

use App\Domain\Event\InvoiceSent;
use App\Infrastructure\Persistence\InvoiceRepository;
use Assert\Assertion;
use Symfony\Component\Messenger\MessageBusInterface;
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
        Assertion::uuid($id);
        $invoice = $this->invoiceRepository->find($id);

        Assertion::notNull($invoice);

        $invoiceLine = LineFactory::create($dto);

        $invoice->addLine($invoiceLine);
        $this->invoiceRepository->save($invoice);
    }

}
