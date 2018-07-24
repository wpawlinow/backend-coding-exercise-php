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


    public function setFilename($filename): ConsoleInputData
    {
        $this->filename = $filename;

        return $this;
    }


    public function setDay($day): ConsoleInputData
    {
        $this->day = $day;

        return $this;
    }


    public function setTime($time): ConsoleInputData
    {
        $this->time = $time;

        return $this;
    }


    public function setLocation($location): ConsoleInputData
    {
        $this->location = $location;

        return $this;
    }


    public function setCovers($covers): ConsoleInputData
    {
        $this->covers = $covers;

        return $this;
    }

}
