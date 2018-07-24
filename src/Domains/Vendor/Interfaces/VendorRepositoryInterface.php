<?php
namespace App\Domains\Vendor\Interfaces;

use App\Domains\Vendor\Entities\Vendor;
use DateTime;

interface VendorRepositoryInterface
{
    public function store(Vendor $vendor): void;

    public function findBy(DateTime $day, DateTime $time, string $location, int $covers): array;
}
