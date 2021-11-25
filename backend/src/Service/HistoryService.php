<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SearchHistory;
use App\Model\SearchData;
use Doctrine\ORM\EntityManagerInterface;

class HistoryService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function recordHistory(SearchData $data): void
    {
        $history = (new SearchHistory())
            ->setQuery(sprintf('%s: %s', $data->getLanguage(),
                $data->getQuery()))
            ->setClientIp($data->getIp())
            ->setSearchedAt($data->getDate());
        $this->entityManager->persist($history);
        $this->entityManager->flush();
    }
}
