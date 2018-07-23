<?php

namespace App\Domains\Data\Commands;


use RuntimeException;

final class ProcessInputFileCommandHandler
{
    private const READ_MODE = 'r';


    public function handle(ProcessInputFileCommand $command): void
    {
        try {
            if (!$command->fileExists()) {
                throw new RuntimeException('File does not exist');
            }

            $file = fopen($command->getFileName(), self::READ_MODE);
            if (!$file) {
                throw new RuntimeException('Could not open input file');
            }

            while (($line = fgets($file)) !== false) {
                printf('%s', $line);
            }

            fclose($file);

        } catch (RuntimeException $e) {
            printf('Error (File: %s, line %s): %s', $e->getFile(), $e->getLine(), $e->getMessage());
        }
    }
}
