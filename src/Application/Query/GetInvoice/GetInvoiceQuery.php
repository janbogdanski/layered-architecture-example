<?php

declare(strict_types=1);

namespace App\Application\Query\GetInvoice;

use App\Application\View\GetInvoiceLineView;
use App\Application\View\GetInvoiceView;
use App\Domain\Model\InvoiceLine;
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