<?php declare(strict_types=1);

namespace App\UseCase;

use App\Exception\ApiCallException;
use App\Model\SearchData;
use App\Service\CacheService;

class PerformCodeSearchUseCase
{
    private CacheService $service;

    public function __construct(CacheService $service)
    {
        $this->service = $service;
    }

    public function execute(SearchData $data): array
    {
        try {
            return $this->service->query($data);
        } catch (\Exception) {
            throw new ApiCallException('There was a problem fetching results for your search');
        }
    }
}
