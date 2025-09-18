<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\AddInvoice;

use App\Core\Application\View\AddInvoiceView;

interface AddInvoicePort
{
    public function execute(AddInvoiceDto $dto): AddInvoiceView;

}
