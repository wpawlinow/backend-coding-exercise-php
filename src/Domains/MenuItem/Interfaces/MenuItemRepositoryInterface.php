<?php
namespace App\Domains\MenuItem\Interfaces;

use App\Domains\MenuItem\Entities\MenuItem;

interface MenuItemRepositoryInterface
{
    public function store(MenuItem $vendor): void;

    public function findBy(array $params): array;
}
