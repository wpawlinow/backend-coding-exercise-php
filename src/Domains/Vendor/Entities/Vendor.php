<?php

namespace App\Domains\Vendor\Entities;


use VasilDakov\Postcode\Postcode;

class Vendor
{
    /** @var string */
    private $name;

    /** @var Postcode */
    private $postcode;

    /** @var integer */
    private $maxHeadcount;


    public function __construct(string $name, Postcode $postcode, int $maxHeadcount)
    {
        $this->name = $name;
        $this->postcode = $postcode;
        $this->maxHeadcount = $maxHeadcount;
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
}
