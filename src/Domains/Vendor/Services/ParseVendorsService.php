<?php
namespace App\Domains\Vendor\Services;
error_reporting (E_ALL);

use App\Domains\MenuItem\Entities\MenuItem;
use App\Domains\Vendor\Entities\Vendor;
use const E_ALL;
use function explode;
use function is_array;
use const PHP_EOL;
use function printf;
use function var_dump;
use VasilDakov\Postcode\Postcode;


class ParseVendorsService
{
    public function parseFromFile(&$file): array
    {
        $vendors = [];

        while (false !== ($line = fgets($file))) {
            do {

                [$name, $postcode, $maxHeadcounts] = explode(';', $line);

                $vendor = new Vendor();
                $vendor->setName($name)
                       ->setPostcode(new Postcode($postcode))
                       ->setMaxHeadcount((int)$maxHeadcounts);

                while (PHP_EOL !== ($line = fgets($file))) {

                    [$name, $allergies, $noticePeriod] = explode(';', $line);

                    if (!empty($allergies)) {
                        $allergies = explode(',', $allergies);
                    }

                    $menuItem = new MenuItem();
                    $menuItem->setName($name)
                             ->setAllergies($allergies ?: [])
                             ->setNoticePeriod((int)$noticePeriod);

                    $vendor->addMenuItem($menuItem);

                    printf('%s %s', 'MENU ITEM:', $line);
                }

                $vendors[] = $vendor;

                printf('%s', $line);
            } while ("\r\n" !== ($line = fgets($file)));
        }
    }
}
