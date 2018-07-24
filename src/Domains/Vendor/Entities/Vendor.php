<?php

namespace App\Domains\Vendor\Entities;


use App\Domains\MenuItem\Entities\MenuItem;
use Doctrine\Common\Collections\ArrayCollection;
use VasilDakov\Postcode\Postcode;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domains\Vendor\Repository\SQLiteVendorRepository")
 */
class Vendor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="object")
     * @var Postcode
     */
    private $postcode;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $maxHeadcount;

    /**
     * @ORM\Column(type="array")
     * @var array
     */
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
