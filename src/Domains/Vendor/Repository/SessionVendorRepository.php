<?php

namespace App\Domains\Vendor\Repository;

use App\Domains\Vendor\Entities\Vendor;
use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use function printf;

class SessionVendorRepository implements VendorRepositoryInterface
{

    public function findBy(array $params): array
    {
        printf('findBy');

        return [

        ];
    }

    public function store(Vendor $vendor): void
    {
        printf('store');
    }
}
