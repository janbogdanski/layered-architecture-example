<?php

declare(strict_types=1);

namespace App\Core\Application\Query\GetInvoice;

use App\Core\Application\View\GetInvoiceLineView;
use App\Core\Application\View\GetInvoiceView;
use App\Core\Domain\Model\InvoiceLine;
use App\Core\Infrastructure\Persistence\InvoiceRepository;
use App\Core\Infrastructure\Persistence\InvoiceRepositoryInterface;
use Assert\Assertion;
use Symfony\Component\Uid\Uuid;

final readonly class GetInvoiceQuery implements GetInvoiceQueryPort
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository,
    )
    {
    }

    public function execute(Uuid $id): GetInvoiceView
    {
        Assertion::uuid($id, 'Invalid invoice id format');

        $invoice = $this->invoiceRepository->find($id);

        Assertion::notNull($invoice, 'Invoice not found');

        $lines = array_map(function (InvoiceLine $line) {
            return new GetInvoiceLineView(
                $line->productName,
                $line->quantity,
                $line->price,
                $line->totalPrice,
            );
        }, $invoice->lines->toArray());

        return new GetInvoiceView(
            id: $invoice->id,
            status: $invoice->status,
            customerName: $invoice->customerName,
            customerEmail: $invoice->customerEmail,
            total: $invoice->totalPrice,
            lines: $lines

        );
    }
}