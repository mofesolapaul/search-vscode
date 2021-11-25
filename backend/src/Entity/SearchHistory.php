<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\SearchHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SearchHistoryRepository::class)
 * @ORM\Table(name="searches")
 */
class SearchHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $clientIp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $query;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTime $searchedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getClientIp(): ?string
    {
        return $this->clientIp;
    }

    public function setClientIp(string $clientIp): self
    {
        $this->clientIp = $clientIp;

        return $this;
    }

    public function getSearchedAt(): ?\DateTime
    {
        return $this->searchedAt;
    }

    public function setSearchedAt(\DateTime $searchedAt): self
    {
        $this->searchedAt = $searchedAt;

        return $this;
    }
}
