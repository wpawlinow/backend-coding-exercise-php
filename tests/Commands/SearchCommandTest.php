<?php

namespace App\Tests;

use App\Commands\SearchCommand;
use League\Tactician\CommandBus;
use Mockery;
use PHPUnit\Framework\TestCase;

use Symfony\Component\Console\Tester\CommandTester;

class SearchCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $mCommandBus = Mockery::mock(CommandBus::class);
        $mCommandBus->shouldReceive('handle')->andReturn(null);
        $searchCommand = new SearchCommand($mCommandBus);
        $commandTester = new CommandTester($searchCommand);
        $commandTester->execute([
            'filename' => '../../resources/input.ebnf',
            'day'      => '23/07/2018',
            'time'     => '10:30',
            'location' => 'NW43QB',
            'covers'   => 15,
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('File name: ../../resources/input.ebnf', $output);
        $this->assertContains('Day: 23/07/2018', $output);
        $this->assertContains('Time: 10:30', $output);
        $this->assertContains('Location: NW43QB', $output);
        $this->assertContains('Covers: 15', $output);
    }
}
