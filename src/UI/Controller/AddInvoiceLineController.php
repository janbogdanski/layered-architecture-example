<?php

declare(strict_types=1);

namespace App\UI\Controller;

use App\Application\Query\GetInvoice\GetInvoiceQueryPort;
use App\Application\UseCase\AddInvoice\AddInvoiceDto;
use App\Application\UseCase\AddInvoice\AddInvoicePort;
use App\Application\UseCase\AddinvoiceLine\AddInvoiceLineDto;
use App\Application\UseCase\AddinvoiceLine\AddInvoiceLineUseCasePort;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final readonly class AddInvoiceLineController
{

    public function __construct(
        private AddInvoiceLineUseCasePort $addInvoiceLine,
    )
    {
    }

    #[Route('/invoices/{id}/lines', name: 'add_invoice_line', methods: ['POST'], format: 'json')]
    public function __invoke(
        Request $request,
        string $id,
        #[MapRequestPayload] AddInvoiceLineDto $dto,
    ): Response
    {
        $this->addInvoiceLine->execute($id, $dto);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}