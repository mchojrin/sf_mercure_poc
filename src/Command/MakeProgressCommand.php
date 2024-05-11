<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Event\ProgressMadeEvent;
use App\Event\ProcessFinishEvent;
use DateTimeImmutable;

#[AsCommand(
    name: 'app:make-progress',
    description: 'Add a short description for your command',
)]
class MakeProgressCommand extends Command
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $progress = 0;

        while ($progress < 100) {
            $io->writeln("Processing...");
            sleep(rand(1, 5));
            $currentProgress = rand(1, 100 - $progress);
            $progress += $currentProgress;
            $io->writeln("Process finished at $progress%");
            $this->eventDispatcher->dispatch(new ProgressMadeEvent(new DateTimeImmutable(), $progress));
        }

        $this->eventDispatcher->dispatch(new ProcessFinishEvent(new DateTimeImmutable()));

        return Command::SUCCESS;
    }
}
