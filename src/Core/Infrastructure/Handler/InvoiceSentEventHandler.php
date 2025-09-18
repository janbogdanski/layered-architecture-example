<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Handler;

use App\Core\Domain\Event\InvoiceSent;
use App\Core\Infrastructure\Persistence\InvoiceRepository;
use App\Notification\Api\NotificationDto;
use App\Notification\Api\NotificationFacadeInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class InvoiceSentEventHandler
{
    public function __construct(
        private NotificationFacadeInterface $notificationFacade,
        private InvoiceRepository $invoiceRepository,
    )
    {
    }

    public function __invoke(InvoiceSent $event): void
    {
        $invoice = $this->invoiceRepository->find($event->invoiceId);

        $this->notificationFacade->notify(new NotificationDto(
            $invoice->id,
            $invoice->customerEmail,
            'Your invoice has been sent.',
            'Some details about the invoice.'
        ));
    }
}
