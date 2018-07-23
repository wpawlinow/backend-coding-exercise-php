<?php
namespace App\Domains\Data\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class ConsoleInputData
{
    /**
     * @Assert\File()
     */
    public $filename;

    /**
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


    public $location;

    /**
     * @Assert\Type("integer")
     */
    public $covers;

}
