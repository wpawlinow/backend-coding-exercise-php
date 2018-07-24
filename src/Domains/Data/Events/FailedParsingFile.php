<?php

namespace App\Domains\Data\Events;

use Symfony\Component\EventDispatcher\Event;

final class FailedParsingFile extends Event
{
    public const NAME = 'parsing_file.failed';

    /** @var string */
    private $line;


    public function __construct(string $line)
    {
        $this->line = $line;
    }


    public function getLine(): string
    {
        return trim($this->line);
    }
}
