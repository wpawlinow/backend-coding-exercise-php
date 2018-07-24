<?php

namespace App\Domains\MenuItem\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domains\MenuItem\Repositories\SQLiteMenuItemRepository")
 */
class MenuItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     * @var array
     */
    private $allergies;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $noticePeriod;


    public function getName(): string
    {
        return $this->name;
    }


    public function getAllergies(): array
    {
        return $this->allergies;
    }


    public function getNoticePeriod(): int
    {
        return $this->noticePeriod;
    }


    public function setName(string $name): MenuItem
    {
        $this->name = $name;

        return $this;
    }


    public function setAllergies(array $allergies): MenuItem
    {
        $this->allergies = $allergies;

        return $this;
    }


    public function setNoticePeriod(int $noticePeriod): MenuItem
    {
        $this->noticePeriod = $noticePeriod;

        return $this;
    }
}
