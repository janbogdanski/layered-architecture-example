<?php

declare(strict_types=1);

namespace App\Domain\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[Orm\Entity]
final class Invoice {

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'uuid', unique: true)]
    public readonly Uuid $id;


    #[ORM\Column(name: 'status', enumType: Status::class)]
    private readonly Status $status;

    #[ORM\Column(name: 'total_price', type: 'integer', length: 255)]
    private readonly int $totalPrice;

    #[OneToMany(targetEntity: InvoiceLine::class, mappedBy: 'invoice')]
    private Collection $lines;

    public function __construct(

        #[ORM\Column(name: 'customer_name', type: 'string', length: 255)]
        private readonly string $customerName,


        #[ORM\Column(name: 'customer_email', type: 'string', length: 255)]
        private readonly string $customerEmail,

    )
    {
        $this->id = Uuid::v4();
        $this->status = Status::DRAFT;
        $this->totalPrice = 0;
    }
}