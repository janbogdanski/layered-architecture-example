<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Core\Application\Query\GetInvoice\GetInvoiceQuery;
use App\Core\Domain\Model\Invoice;
use App\Core\Domain\Model\InvoiceLine;
use App\Core\Infrastructure\Persistence\InMemoryInvoiceRepository;
use PHPUnit\Framework\TestCase;

final class GetInvoiceQueryTest extends TestCase
{

    public function testInvoiceIsExposedInJsonForView(): void
    {
        $repo = new InMemoryInvoiceRepository();

        $invoice = new Invoice('name', 'e@mail.com');
        $invoice->addLine(new InvoiceLine('name', 12, 2));

        $repo->save($invoice);

        $useCase = new GetInvoiceQuery($repo);
       $result = $useCase->execute($invoice->id);

        self::assertJsonStringEqualsJsonString(
            <<<JSON
{
    "customerEmail": "e@mail.com",
    "customerName": "name",
    "id": "$result->id",
    "lines": [
        {
            "productName": "name",
            "quantity": 12,
            "totalUnitPrice": 24,
            "unitPrice": 2
        }
    ],
    "status": "draft",
    "totalUnitPrice": 24
}

JSON,
            json_encode($result)
        );
    }

}
