<?php

namespace App\Domains\MenuItem\Entities;

class MenuItem
{
    /** @var string */
    private $name;

    /** @var array */
    private $allergies;

    /** @var integer */
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
