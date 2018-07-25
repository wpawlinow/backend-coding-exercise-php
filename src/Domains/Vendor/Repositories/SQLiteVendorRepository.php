<?php

namespace App\Domains\Vendor\Repositories;

use App\Domains\MenuItem\Entities\MenuItem;
use App\Domains\Vendor\Entities\Vendor;
use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

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

        foreach ($vendor->getMenuItems() as $menuItem) {
            $this->em->persist($menuItem);
        }
        $this->em->persist($vendor);
        $this->em->flush();
    }


    public function findBy(DateTime $day, DateTime $time, string $location, int $covers): array
    {
        /**
         * Here I would build plain SQL query.
         * it's the best, and fastest way to query data from database.
         */

        $qb = $this->em->createQuery(
            'SELECT mi FROM '.MenuItem::class.' mi'
        );


        return $qb->getResult(Query::HYDRATE_OBJECT);
    }
}
