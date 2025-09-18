<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\StartProcessingInvoice;

use App\Core\Domain\Event\InvoiceSent;
use App\Core\Infrastructure\Persistence\InvoiceRepository;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

final readonly class StartProcessingUseCase implements StartProcessingUseCasePort
{
    public function __construct(
        private InvoiceRepository $invoiceRepository,
        private MessageBusInterface $bus,
    )
    {
    }


    public function execute(Uuid $id): void
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->send();
        $this->invoiceRepository->save($invoice);


        $this->bus->dispatch(new InvoiceSent($invoice->id));
    }
}
