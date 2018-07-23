<?php
namespace App\Domains\Vendor\Interfaces;

use App\Domains\Vendor\Entities\Vendor;

interface VendorRepositoryInterface
{
    public function store(Vendor $vendor): void;

    public function findBy(array $params): array;
}
