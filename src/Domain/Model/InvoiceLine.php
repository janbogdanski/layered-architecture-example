<?php

declare(strict_types=1);

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[Orm\Entity]
final class InvoiceLine {

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'uuid', unique: true)]
    private readonly Uuid $id;
    #[ORM\Column(name: 'total_price', type: 'integer')]
    private readonly int $totalPrice;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'lines')]
    #[ORM\JoinColumn(name: 'invoice_id', referencedColumnName: 'id')]
    private readonly Invoice $invoice;

    public function __construct(
        #[ORM\Column(name: 'product_name', type: 'string', length: 255)]
        private readonly string $productName,

        #[ORM\Column(name: 'quantity', type: 'integer')]
        private readonly int $quantity,

        #[ORM\Column(name: 'price', type: 'integer')]
        private readonly int $price,
    )
    {
        $this->id = Uuid::v4();
    }

}