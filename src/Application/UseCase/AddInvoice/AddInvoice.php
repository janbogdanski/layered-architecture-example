<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddInvoice;

use App\Application\View\AddInvoiceView;
use App\Infrastructure\Persistence\InvoiceRepository;
use Symfony\Component\Uid\Uuid;

final readonly class AddInvoice implements AddInvoicePort
{
    public function __construct(
        private InvoiceRepository $invoiceRepository,
    )
    {
    }

    public function execute(AddInvoiceDto $dto): AddInvoiceView
    {
        $invoice = InvoiceFactory::create($dto);
        $this->invoiceRepository->save($invoice);

        return new AddInvoiceView(id: $invoice->id);
    }

}
