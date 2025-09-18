<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\StartProcessingInvoice;

use Symfony\Component\Uid\Uuid;

interface StartProcessingUseCasePort
{
    public function execute(Uuid $id): void;
}
