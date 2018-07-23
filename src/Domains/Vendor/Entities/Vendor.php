<?php

namespace App\Domains\Vendor\Entities;


use App\Domains\MenuItem\Entities\MenuItem;
use Doctrine\Common\Collections\ArrayCollection;
use VasilDakov\Postcode\Postcode;


class Vendor
{
    /** @var string */
    private $name;

    /** @var Postcode */
    private $postcode;

    /** @var integer */
    private $maxHeadcount;

    /** @var array */
    private $menuItems;


    public function __construct()
    {
        $this->menuItems = new ArrayCollection();
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getPostcode(): Postcode
    {
        return $this->postcode;
    }


    public function getMaxHeadcount(): int
    {
        return $this->maxHeadcount;
    }


    public function setName(string $name): Vendor
    {
        $this->name = $name;

        return $this;
    }


    public function setPostcode(Postcode $postcode): Vendor
    {
        $this->postcode = $postcode;

        return $this;
    }


    public function setMaxHeadcount(int $maxHeadcount): Vendor
    {
        $this->maxHeadcount = $maxHeadcount;

        return $this;
    }


    public function getMenuItems(): array
    {
        return $this->menuItems;
    }


    public function addMenuItem(MenuItem $menuItem): void
    {
        $this->menuItems->add($menuItem);
    }
}
