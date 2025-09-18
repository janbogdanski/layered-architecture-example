<?php

declare(strict_types=1);

namespace App\Application\UseCase\StartProcessingInvoice;

use Symfony\Component\Uid\Uuid;

interface StartProcessingUseCasePort
{
    public function execute(Uuid $id): void;
}
