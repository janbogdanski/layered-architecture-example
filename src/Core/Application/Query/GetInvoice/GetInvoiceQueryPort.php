<?php

declare(strict_types=1);


namespace App\Core\Application\Query\GetInvoice;

use App\Core\Application\View\GetInvoiceView;
use Symfony\Component\Uid\Uuid;

interface GetInvoiceQueryPort {
    public function execute(Uuid $id): GetInvoiceView;
}