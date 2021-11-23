<?php declare(strict_types=1);

namespace App\UseCase;

use App\Exception\ApiCallException;
use App\Model\SearchData;
use App\Service\SearchService;

class PerformCodeSearchUseCase
{
    private SearchService $service;

    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function execute(SearchData $data): array
    {
        try {
            return $this->service->search($data);
        } catch (\Exception) {
            throw new ApiCallException('There was a problem fetching results for your search');
        }
    }
}
