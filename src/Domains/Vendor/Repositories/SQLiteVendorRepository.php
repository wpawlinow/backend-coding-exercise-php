<?php

namespace App\Domains\Vendor\Repositories;

use App\Domains\Vendor\Entities\Vendor;
use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class SQLiteVendorRepository implements VendorRepositoryInterface
{

    /** @var EntityManagerInterface */
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function store(Vendor $vendor): void
    {
        $this->em->persist($vendor);
        $this->em->flush();
    }


    public function findBy(DateTime $day, DateTime $time, string $location, int $covers): array
    {
        /**
         * Here I would build plain SQL query.
         * it's the best, and fastest way to query data from database.
         */

        /* $qb = $this->em->createNativeQuery(''); */

        /* Hydrate results to array */

        return [];
    }
}
