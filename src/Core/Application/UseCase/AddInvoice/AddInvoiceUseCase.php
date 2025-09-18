<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddInvoice;

use App\Core\Application\View\AddInvoiceView;
use App\Core\Infrastructure\Persistence\InvoiceRepository;

final readonly class AddInvoiceUseCase implements AddInvoiceUseCasePort
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
