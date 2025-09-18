<?php

declare(strict_types=1);

namespace App\Notification\UI\Controller;

use App\Core\Application\UseCase\AddInvoice\AddInvoiceDto;
use App\Core\Application\UseCase\AddInvoice\AddInvoiceUseCasePort;
use App\Notification\Application\UseCase\NotificationDeliveredUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final readonly class NotificationDeliveredController
{

    public function __construct(
        private NotificationDeliveredUseCase $notificationDeliveredUseCase,
    )
    {
    }

    #[Route('/notification/hook/delivered/{reference}', name: 'notification_delivered', methods: ['GET'], format: 'json')]
    public function __invoke(
        Request $request,
    ): Response
    {
        $this->notificationDeliveredUseCase->execute($request->attributes->get('reference'));

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}