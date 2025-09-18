<?php

declare(strict_types=1);

namespace App\Core\UI\Controller;

use App\Core\Application\UseCase\AddinvoiceLine\AddInvoiceLineDto;
use App\Core\Application\UseCase\AddinvoiceLine\AddInvoiceLineUseCasePort;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

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
        Uuid $id,
        #[MapRequestPayload] AddInvoiceLineDto $dto,
    ): Response
    {
        $this->addInvoiceLine->execute($id, $dto);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}