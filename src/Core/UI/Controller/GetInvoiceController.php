<?php

declare(strict_types=1);

namespace App\Core\UI\Controller;

use App\Core\Application\Query\GetInvoice\GetInvoiceQueryPort;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

final readonly class GetInvoiceController {

    public function __construct(
        private GetInvoiceQueryPort $getInvoiceQueryPort,
    )
    {
    }

    #[Route('/invoices/{id}', name: 'get_invoice', methods: ['GET'], format: 'json')]
    public function __invoke(Uuid $id): Response
    {
        $invoice = $this->getInvoiceQueryPort->execute($id);

        return new JsonResponse($invoice);
        // TODO: Implement __invoke() method.
    }
}