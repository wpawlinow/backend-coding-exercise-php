<?php

namespace App\Domains\Data\Entities;

use Symfony\Component\Validator\Constraints as Assert;

class ConsoleInputData
{
    /**
     * @Assert\NotBlank()
     * @Assert\File()
     */
    public $filename;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime(
     *     format="d/m/Y",
     *     message="Please provide valid dd/mm/yyyy day format"
     * )
     */
    public $day;

    /**
     * @Assert\DateTime(
     *     format="H:i",
     *     message="Please provide valid HH:mm time format"
     * )
     */
    public $time;

    /**
     * @Assert\Regex("/([Gg][Ii][Rr]0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))[0-9][A-Za-z]{2})/")
     */
    public $location;

    /**
     * @Assert\Type("integer")
     */
    public $covers;


    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): ConsoleInputData
    {
        $this->filename = $filename;

        return $this;
    }


    public function setDay(string $day): ConsoleInputData
    {
        /**
         * Here should DateTime::createFromFormat() and rest
         * of the system should be a bit refactored
         */
        $this->day = $day;

        return $this;
    }


    public function setTime(string $time): ConsoleInputData
    {
        /**
         * Here should DateTime::createFromFormat() and rest
         * of the system should be a bit refactored
         */
        $this->time = $time;

        return $this;
    }


    public function setLocation(string $location): ConsoleInputData
    {
        $this->location = $location;

        return $this;
    }


    public function setCovers(int $covers): ConsoleInputData
    {
        $this->covers = $covers;

        return $this;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getLocation(): string
    {
        return $this->location;
    }


    public function getCovers(): int
    {
        return $this->covers;
    }
}
