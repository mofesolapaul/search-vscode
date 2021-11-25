<?php declare(strict_types=1);

namespace App\UseCase;

use App\Exception\ApiCallException;
use App\Message\RecordSearchMessage;
use App\Model\SearchData;
use App\Service\CacheService;
use Symfony\Component\Messenger\MessageBusInterface;

class PerformCodeSearchUseCase
{
    private CacheService $service;
    private MessageBusInterface $messageBus;

    public function __construct(
        CacheService $service,
        MessageBusInterface $messageBus
    ) {
        $this->service = $service;
        $this->messageBus = $messageBus;
    }

    public function execute(SearchData $data): array
    {
        try {
            $result = $this->service->query($data);
            $this->messageBus->dispatch(new RecordSearchMessage($data));

            return $result;
        } catch (\Exception $ex) {
            throw new ApiCallException('There was a problem fetching results for your search');
        }
    }
}
