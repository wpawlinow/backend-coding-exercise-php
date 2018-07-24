<?php

namespace App\Domains\Data\Commands;


use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use App\Domains\Vendor\Services\ParseVendorsService;
use RuntimeException;


final class ParseInputFileCommandHandler
{
    private const READ_MODE = 'r';

    /** @var VendorRepositoryInterface */
    private $repository;

    /** @var ParseVendorsService */
    private $parseVendorsService;


    public function __construct(
        VendorRepositoryInterface $repository,
        ParseVendorsService $parseVendorsService
    )
    {
        $this->repository = $repository;
        $this->parseVendorsService = $parseVendorsService;
    }


    public function handle(ParseInputFileCommand $command): void
    {
        try {

            if (false === $command->fileExists()) {
                throw new RuntimeException('File does not exist');
            }

            $file = fopen($command->getFileName(), self::READ_MODE);

            if (!$file) {
                throw new RuntimeException('Could not open input file');
            }

            $vendors = $this->parseVendorsService->retrieveFromFile($file);

            fclose($file);

            foreach ($vendors as $vendor) {
                $this->repository->store($vendor);
            }

        } catch (RuntimeException $e) {
            printf('Error (File: %s, line %s): %s', $e->getFile(), $e->getLine(), $e->getMessage());
        }
    }
}
