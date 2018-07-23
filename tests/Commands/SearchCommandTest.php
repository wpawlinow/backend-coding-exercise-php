<?php

namespace App\Tests;

use App\Commands\SearchCommand;
use League\Tactician\CommandBus;
use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SearchCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $mCommandBus = Mockery::mock(CommandBus::class);
        $mCommandBus->expects('handle')->times(2)->andReturn(null);

        $mValidator = Mockery::mock(ValidatorInterface::class);
        $mValidator->expects('validate')->andReturn(null);

        $searchCommand = new SearchCommand($mCommandBus, $mValidator);
        $commandTester = new CommandTester($searchCommand);
        $commandTester->execute([
            'filename' => 'resources/input.ebnf',
            'day'      => '23/07/2018',
            'time'     => '10:30',
            'location' => 'G58 1SB',
            'covers'   => 15,
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('Correct input. Processing...', $output);
    }


    public function testValidationFail(): void
    {
        $mCommandBus = Mockery::mock(CommandBus::class);
        $mCommandBus->expects('handle')->andReturn(null);

        $error = new ConstraintViolation(
            'Please provide valid UK postcode format',
            '',
            [],
            'G5]]] 1SB',
            '',
            'G5]]] 1SB'
        );
        $validator = $this->createMock(ValidatorInterface::class);
        $validator->method('validate')
                  ->will($this->returnValue(new ConstraintViolationList([$error])));


        $searchCommand = new SearchCommand($mCommandBus, $validator, 'UK');
        $commandTester = new CommandTester($searchCommand);
        $commandTester->execute([
            'filename' => '--resources/input.ebnf',
            'day'      => '2307/2018',
            'time'     => '10:30',
            'location' => 'G5]]] 1SB',
            'covers'   => 15,
        ]);

        $output = $commandTester->getDisplay();

        $this->assertContains('Please provide valid UK postcode format', $output);
    }
}
