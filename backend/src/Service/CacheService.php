<?php declare(strict_types=1);

namespace App\Service;

use App\Model\SearchData;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CacheService
{
    private ContainerInterface $container;
    private AdapterInterface $adapter;
    private SearchService $searchService;

    public function __construct(
        ContainerInterface $container,
        AdapterInterface $adapter,
        SearchService $searchService
    ) {
        $this->container = $container;
        $this->adapter = $adapter;
        $this->searchService = $searchService;
    }

    public function query(SearchData $data): array
    {
        $url = sprintf(
            $this->container->getParameter('vscode_search_api'),
            $data->getQuery(),
            $data->getLanguage()
        );
        $cacheKey = sha1($url);
        $cacheItem = $this->adapter->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $response = $this->searchService->search($url);
        $cacheItem->set($response)->expiresAt(new \DateTime('+3 minutes'));
        $this->adapter->save($cacheItem);

        return $response;
    }
}
