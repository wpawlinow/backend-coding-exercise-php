<?php

namespace App\Domains\Data\Commands;


final class ParseInputFileCommand
{
    /** @var string */
    private $fileName;


    public function __construct(string $fileName = '')
    {
        $this->fileName = $fileName;
    }


    public function fileExists(): bool
    {
        return file_exists($this->fileName);
    }


    public function getFileName(): string
    {
        return $this->fileName;
    }
}
