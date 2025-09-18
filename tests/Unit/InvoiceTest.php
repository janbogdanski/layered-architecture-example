<?php

declare(strict_types=1);

namespace App\Tests\Unit;


use App\Core\Domain\Model\Invoice;
use App\Core\Domain\Model\InvoiceLine;
use App\Core\Domain\Model\Status;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(Invoice::class)]
#[CoversClass(InvoiceLine::class)]
final class InvoiceTest extends TestCase
{


    public function testCreateInvoiceInDraft(): void
    {
        $invoice = new Invoice('customer name', 'customer@email.com');

        self::assertSame( Status::DRAFT, $invoice->status);

    }

    public function testCannotCreateInvoiceWithoutName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Customer name is required');

        $invoice = new Invoice('', 'customer@email.com');

        self::assertSame( Status::DRAFT, $invoice->status);

    }

    public static function invalidEmails(): array
    {
        return [
            'empty email' => [''],
            'invalid email' => ['customer@email'],
        ];
    }
    #[DataProvider('invalidEmails')]
    public function testCannotCreateInvoiceWithoutProperEmail(string $email): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid email');

        $invoice = new Invoice('customer name', $email);

        self::assertEquals($invoice->status, Status::DRAFT);

    }

    public function testCanAddLine(): void
    {
        $invoice = new Invoice('customer name', 'customer@email.com');
        $invoice->addLine(new InvoiceLine('product name', 100, 2));

        self::assertCount(1, $invoice->lines);
        self::assertSame('product name', $invoice->lines->first()->productName);;
        self::assertSame(100, $invoice->lines->first()->quantity);;
        self::assertSame(2, $invoice->lines->first()->price);;
        self::assertSame(200, $invoice->lines->first()->totalPrice);;
    }


    public function testCannotAddLineWithoutProductName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Product name is required');


        $invoice = new Invoice('customer name', 'customer@email.com');
        $invoice->addLine(new InvoiceLine('', 100, 2));
    }

    public static function invalidQuantity(): array
    {
        return [
            'negative quantity' => [-1],
            'zero quantity' => [0],
        ];
    }

    #[DataProvider('invalidQuantity')]
    public function testCannotAddLineWithInvalidQuantity(mixed $quantity): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Quantity must be greater than 0');


        $invoice = new Invoice('customer name', 'customer@email.com');
        $invoice->addLine(new InvoiceLine('name', $quantity, 2));

    }

    public static function invalidPrice(): array
    {
        return [
            'negative price' => [-1],
            'zero price' => [0],
        ];
    }

    #[DataProvider('invalidPrice')]
    public function testCannotAddLineWithInvalidPrice(mixed $price): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unit price must be greater than 0');

        $invoice = new Invoice('customer name', 'customer@email.com');
        $invoice->addLine(new InvoiceLine('name', 12, $price));

    }

    public function testCanSend(): void
    {
        $invoice = new Invoice('customer name', 'customer@email.com');
        $invoice->addLine(new InvoiceLine('name', 12, 1));

        $invoice->send();

        self::assertSame(Status::SENDING, $invoice->status);

    }
    public function testCannotSendWithoutLines(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invoice must have at least one line');


        $invoice = new Invoice('customer name', 'customer@email.com');

        $invoice->send();

    }

    public function testCannotSendInInvalidStatus(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invoice already sent');

        $invoice = new Invoice('customer name', 'customer@email.com');
        $invoice->addLine(new InvoiceLine('name', 12, 1));
        $invoice->send();

        $invoice->send();
    }

    public function testMarksSentToClient(): void
    {
        $invoice = new Invoice('customer name', 'customer@email.com');
        $invoice->addLine(new InvoiceLine('name', 12, 1));
        $invoice->send();

        $invoice->sentToClient();

        self::assertSame(Status::SENT_TO_CLIENT, $invoice->status);


    }

}
