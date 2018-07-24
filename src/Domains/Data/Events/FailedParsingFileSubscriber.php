<?php

namespace App\Domains\Data\Events;


use InvalidArgumentException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FailedParsingFileSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            FailedParsingFile::NAME => ['onParsingFileFailed', 0],
        ];
    }


    public function onParsingFileFailed(FailedParsingFile $event): void
    {
        // ... Here can be anything to handle this fail
        throw new InvalidArgumentException("Parsing line '{$event->getLine()}' failed");
    }
}
