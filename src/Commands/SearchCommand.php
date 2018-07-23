<?php

namespace App\Commands;

use App\Domains\Data\Commands\ProcessInputFileCommand;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SearchCommand extends Command
{
    /** @var string */
    protected $commandName = 'app:search';

    /** @var string */
    protected $commandDesc = 'Command for searching vendors';

    /** @var CommandBus */
    private $commandBus;


    public function __construct(CommandBus $commandBus)
    {
        parent::__construct($this->commandName);
        $this->commandBus = $commandBus;
    }


    protected function configure(): void
    {
        $this->setName($this->commandName)
             ->setDescription($this->commandDesc)
             ->addArgument('filename',
                 InputArgument::OPTIONAL,
                 'input file with the vendors data'
             )
             ->addArgument('day',
                 InputArgument::OPTIONAL,
                 'delivery day (dd/mm/yy)'
             )
             ->addArgument('time',
                 InputArgument::OPTIONAL,
                 'delivery time in 24h format (hh:mm)'
             )
             ->addArgument('location',
                 InputArgument::OPTIONAL,
                 'delivery location (postcode without spaces, e.g. NW43QB)'
             )
             ->addArgument('covers',
                 InputArgument::OPTIONAL,
                 'number of people to feed'
             );
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('File name: '.$input->getArgument('filename'));
        $output->writeln('Day: '.$input->getArgument('day'));
        $output->writeln('Time: '.$input->getArgument('time'));
        $output->writeln('Location: '.$input->getArgument('location'));
        $output->writeln('Covers: '.$input->getArgument('covers'));

        $this->commandBus->handle(new ProcessInputFileCommand((string)$input->getArgument('filename')));
    }
}
