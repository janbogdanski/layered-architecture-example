<?php

declare(strict_types=1);


namespace App\Application\Query\GetInvoice;

use App\Application\View\GetInvoiceView;

interface GetInvoiceQueryPort {
    public function execute(string $id): GetInvoiceView;
}