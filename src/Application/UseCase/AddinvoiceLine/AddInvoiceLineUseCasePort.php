<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddinvoiceLine;

interface AddInvoiceLineUseCasePort
{
    public function execute(string $id, AddInvoiceLineDto $dto): void;

}
