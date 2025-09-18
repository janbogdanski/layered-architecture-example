<?php

declare(strict_types=1);

namespace App\Core\UI\Controller;

use App\Core\Application\UseCase\StartProcessingInvoice\StartProcessingUseCasePort;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

final readonly class StartProcessingInvoiceController
{

    public function __construct(
        private StartProcessingUseCasePort $startProcessingUseCase,
    )
    {
    }

    #[Route('/invoices/{id}/process', name: 'start_processing_invoice', methods: ['PUT'], format: 'json')]
    public function __invoke(
        Request $request,
        Uuid $id,
    ): Response
    {
        $this->startProcessingUseCase->execute($id);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}