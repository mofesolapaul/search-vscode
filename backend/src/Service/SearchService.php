<?php declare(strict_types=1);

namespace App\Service;

use App\Model\SearchData;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SearchService
{
    private ContainerInterface $container;
    private HttpClientInterface $client;

    public function __construct(
        ContainerInterface $container,
        HttpClientInterface $client
    ) {
        $this->container = $container;
        $this->client = $client;
    }

    public function search(SearchData $data): array
    {
        $url = sprintf(
            $this->container->getParameter('vscode_search_api'),
            $data->getQuery(),
            $data->getLanguage()
        );
        $response = $this->client->request('GET', $url);

        return json_decode($response->getContent(), true);
    }
}
