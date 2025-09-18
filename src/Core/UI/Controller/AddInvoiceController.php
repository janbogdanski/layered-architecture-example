<?php

declare(strict_types=1);

namespace App\Core\UI\Controller;

use App\Core\Application\UseCase\AddInvoice\AddInvoiceDto;
use App\Core\Application\UseCase\AddInvoice\AddInvoicePort;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final readonly class AddInvoiceController
{

    public function __construct(
        private AddInvoicePort $addInvoice,
    )
    {
    }

    #[Route('/invoices', name: 'add_invoice', methods: ['POST'], format: 'json')]
    public function __invoke(
        Request $request,
        #[MapRequestPayload] AddInvoiceDto $dto,
    ): Response
    {
        $id = $this->addInvoice->execute($dto);

        return new JsonResponse($id);
    }
}