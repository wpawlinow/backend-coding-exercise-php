<?php

namespace App\Domains\Vendor\Services;


use App\Domains\Data\Events\FailedParsingFile;
use App\Domains\Data\Events\FailedParsingFileSubscriber;
use App\Domains\MenuItem\Entities\MenuItem;
use App\Domains\Vendor\Entities\Vendor;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use VasilDakov\Postcode\Postcode;


class ParseVendorsService
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;


    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }


    public function retrieveFromFile(&$file): array
    {
        $vendors = [];

        while (false !== ($line = fgets($file))) {
            if (!empty($line)) {

                [$name, $postcode, $maxHeadcounts] = explode(';', $line);

                /**
                 * This regexp ensure its vendor line
                 * Here I dispatch event to handle somewhere else.
                 * It depends on business logic. If we got 5 GB EBNF file to parse,
                 * we must decide if we parse with skipping invalid lines or we continue.
                 * Continue might be tricky - imagine first 10 rows are correct
                 * and rest of the 5 GB file is not - application eats your resources
                 * Production way I'll throw exceptions/dispatch events
                 * if something isnt't good, and then handle this
                 */
                if ((int)$maxHeadcounts < 1) {
                    $this->eventDispatcher->dispatch(
                        FailedParsingFile::NAME,
                        new FailedParsingFile($line
                        ));
                }

                $vendor = (new Vendor())
                    ->setName($name)
                    ->setPostcode(new Postcode($postcode))
                    ->setMaxHeadcount((int)$maxHeadcounts);

                while (PHP_EOL !== ($line = fgets($file))) {

                    if (false === $line) {
                        break;
                    }

                    [$name, $allergies, $noticePeriod] = explode(';', $line);

                    if (!empty($allergies)) {
                        $allergies = explode(',', $allergies);
                    }

                    $menuItem = (new MenuItem())
                        ->setName($name)
                        ->setAllergies($allergies ?: [])
                        ->setNoticePeriod((int)$noticePeriod);

                    $vendor->addMenuItem($menuItem);
                }

                $vendors[] = $vendor;
            }
        }

        return $vendors;
    }
}
