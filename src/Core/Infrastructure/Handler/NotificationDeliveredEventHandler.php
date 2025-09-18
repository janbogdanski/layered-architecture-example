<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Handler;

use App\Core\Domain\Event\InvoiceSent;
use App\Core\Infrastructure\Persistence\InvoiceRepository;
use App\Notification\Api\Event\ResourceDelivered;
use App\Notification\Api\NotificationDto;
use App\Notification\Api\NotificationFacadeInterface;
use Assert\Assertion;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class NotificationDeliveredEventHandler
{
    public function __construct(
        private InvoiceRepository $invoiceRepository,
    )
    {
    }

    public function __invoke(ResourceDelivered $event): void
    {
        $invoice = $this->invoiceRepository->find($event->resourceId);

        Assertion::notNull($invoice, 'Invoice not found');

        $invoice->sentToClient();

        $this->invoiceRepository->save($invoice);
    }
}
