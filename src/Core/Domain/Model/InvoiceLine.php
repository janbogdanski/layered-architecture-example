<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[Orm\Entity]
final class InvoiceLine {

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'uuid', unique: true)]
    public readonly Uuid $id;
    #[ORM\Column(name: 'total_price', type: 'integer')]
    public readonly int $totalPrice;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'lines')]
    #[ORM\JoinColumn(name: 'invoice_id', referencedColumnName: 'id')]
    public readonly Invoice $invoice;

    public function __construct(
        #[ORM\Column(name: 'product_name', type: 'string', length: 255)]
        public readonly string $productName,

        #[ORM\Column(name: 'quantity', type: 'integer')]
        public readonly int $quantity,

        #[ORM\Column(name: 'price', type: 'integer')]
        public readonly int $price,
    )
    {
        $this->id = Uuid::v4();
        $this->totalPrice = $this->quantity * $this->price;

        Assertion::notEmpty($this->productName, 'Product name is required');;
        Assertion::greaterThan($this->quantity, 0, 'Quantity must be greater than 0');
        Assertion::greaterThan($this->price, 0, 'Unit price must be greater than 0');
    }

    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }
}