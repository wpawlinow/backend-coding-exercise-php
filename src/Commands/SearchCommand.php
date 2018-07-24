<?php

namespace App\Commands;

use App\Domains\Data\Commands\ParseInputFileCommand;
use App\Domains\Data\Commands\PostcodeValidateCommand;
use App\Domains\Data\Entities\ConsoleInputData;
use App\Domains\Vendor\Services\SearchVendorsService;
use League\Tactician\CommandBus;
use RuntimeException;
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

    /** @var SearchVendorsService */
    private $searchVendorsService;


    public function __construct(
        CommandBus $commandBus,
        ValidatorInterface $validator,
        SearchVendorsService $searchVendorsService
    ) {
        parent::__construct($this->commandName);

        $this->commandBus = $commandBus;
        $this->validator = $validator;
        $this->searchVendorsService = $searchVendorsService;
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
        try {

            $consoleInputData = (new ConsoleInputData())
                ->setFilename($input->getArgument('filename'))
                ->setDay($input->getArgument('day'))
                ->setTime($input->getArgument('time'))
                ->setLocation($input->getArgument('location'))
                ->setCovers((int)$input->getArgument('covers'));

            /** @var ConstraintViolationList */
            $violations = $this->validator->validate($consoleInputData);

            /** It seems here I can't use 0 !== \count($violations) */
            if ($violations instanceof ConstraintViolationList && $violations->count()) {
                throw new RuntimeException((string)$violations);
            }

            $this->commandBus->handle(new ParseInputFileCommand(__DIR__."/../../{$consoleInputData->getFilename()}"));

            $results = $this->searchVendorsService->search($consoleInputData);

            /* Simple result presentation */
            foreach ($results as $result) {
                sprintf('%s', $result);
            }

        } catch (Throwable $ex) {
            $output->writeln($ex->getMessage());

            return;
        }
    }
}
