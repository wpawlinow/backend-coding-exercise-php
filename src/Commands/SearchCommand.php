<?php

namespace App\Commands;

use App\Domains\Data\Commands\ParseInputFileCommand;
use App\Domains\Data\Commands\PostcodeValidateCommand;
use App\Domains\Data\Entities\ConsoleInputData;
use League\Tactician\CommandBus;
use function session_destroy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;


class SearchCommand extends Command
{
    /** @var string */
    protected $commandName = 'app:search';

    /** @var string */
    protected $commandDesc = 'Command for searching vendors';

    /** @var CommandBus */
    private $commandBus;

    /** @var ValidatorInterface */
    private $validator;


    public function __construct(CommandBus $commandBus, ValidatorInterface $validator)
    {
        parent::__construct($this->commandName);
        $this->commandBus = $commandBus;
        $this->validator = $validator;

        /* Demo purposes */
        session_start();
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
        $consoleInputData = new ConsoleInputData();
        $consoleInputData->filename = $input->getArgument('filename');
        $consoleInputData->day = $input->getArgument('day');
        $consoleInputData->time = $input->getArgument('time');
        $consoleInputData->location = $input->getArgument('location');
        $consoleInputData->covers = (int)$input->getArgument('covers');

        try {

            /** @var ConstraintViolationList */
            $violations = $this->validator->validate($consoleInputData);

            if ($violations instanceof ConstraintViolationList && $violations->count()) {
                $violationsString = (string)$violations;
                throw new \RuntimeException($violationsString);
            }

            $this->commandBus->handle(new ParseInputFileCommand(__DIR__.'/../../'.$input->getArgument('filename')));
            $output->writeln('Correct input. Processing...');

        } catch (Throwable $ex) {
            $output->writeln($ex->getMessage());

            return;
        } finally {
            /* Demo purposes */
            session_destroy();
        }
    }
}
