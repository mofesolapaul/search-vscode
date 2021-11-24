<?php declare(strict_types=1);

namespace App\Service;

use App\Model\SearchData;
use Doctrine\ORM\EntityManagerInterface;
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

    private function parseResponseData(string $response): array
    {
        $data = json_decode($response, true);
        if (empty($data['items'])) {
            return [];
        }

        return array_map(function ($item) {
            return [
                'name'     => $item['name'],
                'path'     => $item['path'],
                'html_url' => $item['html_url'],
            ];
        }, $data['items']);
    }

    public function search(SearchData $data): array
    {
        $url = sprintf(
            $this->container->getParameter('vscode_search_api'),
            $data->getQuery(),
            $data->getLanguage()
        );
        $response = $this->client->request('GET', $url);

        return $this->parseResponseData($response->getContent());
    }
}
