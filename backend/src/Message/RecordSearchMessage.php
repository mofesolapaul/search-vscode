<?php declare(strict_types=1);

namespace App\Message;

use App\Model\SearchData;

final class RecordSearchMessage
{
    private SearchData $searchData;

    public function __construct(SearchData $searchData)
    {
        $this->searchData = $searchData;
    }

    public function getSearchData(): SearchData
    {
        return $this->searchData;
    }

    public function setSearchData(SearchData $searchData): void
    {
        $this->searchData = $searchData;
    }
}
