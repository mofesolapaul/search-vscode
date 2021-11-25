<?php declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class SearchData
{
    #[Assert\NotBlank]
    private string $query;

    #[Assert\NotBlank]
    private string $language;

    #[Assert\NotBlank]
    private string $ip;

    private \DateTime $date;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
        $this->date = new \DateTime();
    }

    public function getQuery(): string
    {
        return urlencode($this->query);
    }

    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
