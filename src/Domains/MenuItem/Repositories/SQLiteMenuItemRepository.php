<?php

namespace App\Domains\MenuItem\Repositories;

use App\Domains\MenuItem\Entities\MenuItem;
use App\Domains\MenuItem\Interfaces\MenuItemRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class SQLiteMenuItemRepository implements MenuItemRepositoryInterface
{

    /** @var EntityManagerInterface */
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    private function getEntityClass(): string
    {
        return MenuItem::class;
    }


    public function store(MenuItem $vendor): void
    {
        $this->em->persist($vendor);
        $this->em->flush();
    }


    public function findBy(array $params): array
    {
        $this->em->getRepository($this->getEntityClass())->findBy($params);
    }
}
