<?php

declare(strict_types=1);

namespace App\Domain\Model;

enum Status: string
{
    case DRAFT = "draft";
    case SENDING = "sending";
    case SENT_TO_CLIENT = "sent-to-client";
    case CLIENT = "client";
}