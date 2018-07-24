<?php

namespace App\Domains\Vendor\Services;

use App\Domains\Data\Entities\ConsoleInputData;
use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use DateTime;

class SearchVendorsService
{
    /** @var VendorRepositoryInterface */
    private $repository;


    public function __construct(VendorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function search(ConsoleInputData $inputData): array
    {
        /* Not the most beauty solution here. */
        $day = new DateTime();
        $day->createFromFormat('dd/mm/yy', $inputData->getDay());

        $time = new DateTime();
        $time->createFromFormat('H:i', $inputData->getTime());

        return $this->repository->findBy(
            $day,
            $time,
            $inputData->getLocation(),
            $inputData->getCovers()
        );
    }
}
