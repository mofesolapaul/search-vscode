<?php declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\RecordSearchMessage;
use App\Service\HistoryService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class RecordSearchMessageHandler implements MessageHandlerInterface
{
    private HistoryService $service;

    public function __construct(HistoryService $service)
    {
        $this->service = $service;
    }

    public function __invoke(RecordSearchMessage $message)
    {
        $this->service->recordHistory($message->getSearchData());
    }
}
