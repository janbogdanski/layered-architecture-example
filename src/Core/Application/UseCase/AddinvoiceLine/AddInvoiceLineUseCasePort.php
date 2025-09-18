<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddinvoiceLine;

use Symfony\Component\Uid\Uuid;

interface AddInvoiceLineUseCasePort
{
    public function execute(Uuid $id, AddInvoiceLineDto $dto): void;

}
