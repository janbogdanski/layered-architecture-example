<?php

declare(strict_types=1);

namespace App\Application\UseCase\AddInvoice;

use App\Application\View\AddInvoiceView;
use Symfony\Component\Uid\Uuid;

interface AddInvoicePort
{
    public function execute(AddInvoiceDto $dto): AddInvoiceView;

}
