<?php declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SearchService
{
    private HttpClientInterface $client;

    public function __construct(
        HttpClientInterface $client
    ) {
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

    public function search(string $url): array
    {
        $response = $this->client->request('GET', $url);

        return $this->parseResponseData($response->getContent());
    }
}
