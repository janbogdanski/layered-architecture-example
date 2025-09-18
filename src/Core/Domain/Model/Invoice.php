<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[Orm\Entity]
final class Invoice {

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'uuid', unique: true)]
    public readonly Uuid $id;


    #[ORM\Column(name: 'status', enumType: Status::class)]
    public  Status $status;

    #[ORM\Column(name: 'total_price', type: 'integer', length: 255)]
    public  int $totalPrice;

    #[ORM\OneToMany(targetEntity: InvoiceLine::class, mappedBy: 'invoice' , cascade: ['persist', 'remove'], orphanRemoval: true)]
    public Collection $lines;

    public function __construct(

        #[ORM\Column(name: 'customer_name', type: 'string', length: 255)]
        public readonly string $customerName,


        #[ORM\Column(name: 'customer_email', type: 'string', length: 255)]
        public readonly string $customerEmail,

    )
    {
        $this->id = Uuid::v4();
        $this->status = Status::DRAFT;
        $this->totalPrice = 0;
        $this->lines = new ArrayCollection();
    }

    public function addLine(InvoiceLine $line): void
    {
        $this->lines->add($line);
        $line->setInvoice($this);
        $this->totalPrice += $line->totalPrice;
    }

    public function send(): void
    {
        Assertion::eq($this->status, Status::DRAFT, 'Invoice already sent');
        Assertion::minCount($this->lines, 1, 'Invoice must have at least one line');
        //in requirements there was also check for quantity and price to be greater than 0 - it is checked on invoice line level before adding to invoice

        $this->status = Status::SENDING;
    }

    public function sentToClient(): void
    {
        Assertion::eq($this->status, Status::SENDING, 'Invoice is not sending');

        $this->status = Status::SENT_TO_CLIENT;
    }

}