<?php

namespace App\Domains\Vendor\Repositories;

use App\Domains\Vendor\Entities\Vendor;
use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class SQLiteVendorRepository implements VendorRepositoryInterface
{

    /** @var EntityManagerInterface */
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    private function getEntityClass(): string
    {
        return Vendor::class;
    }


    public function store(Vendor $vendor): void
    {
        $this->em->persist($vendor);
        $this->em->flush();
    }


    public function findBy(array $params): array
    {
        $this->em->getRepository($this->getEntityClass())->findBy($params);
    }
}
