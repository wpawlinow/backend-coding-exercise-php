<?php

namespace App\Domains\Data\Commands;


final class ProcessInputFileCommandHandler
{
    private const READ_MODE = 'r';


    public function handle(ProcessInputFileCommand $command): void
    {
        try {
            if (!$command->fileExists()) {
                throw new \RuntimeException('File does not exist');
            }

            $file = fopen($command->getInputFile(), self::READ_MODE);
            if (!$file) {
                throw new \RuntimeException('Could not open input file');
            }

            while (($line = fgets($file)) !== false) {
                sprintf('%s', $line);
            }

            fclose($file);

        } catch (\RuntimeException $e) {
            sprintf('Error (File: %s, line %s): %s', $e->getFile(), $e->getLine(), $e->getMessage());
        }
    }
}
