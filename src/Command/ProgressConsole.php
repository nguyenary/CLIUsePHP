<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProgressConsole extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'test2';

    protected function configure(): void
    {
        $this
            // Mô tả hiển thị ghi gõ console hoặc console list
            ->setDescription('Creates a new user nguyen')

            // Hiện thị mô tả đầy đủ khi chạy với lệnh console app:create-user --help
            ->setHelp('This command allows you to create a user... nguyên 222')
            // ->addArgument('names', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Who do you want to greet (separate multiple names with a space)?')
            ->addArgument('name', InputArgument::REQUIRED, 'Who do you want to greet?')
            ->addArgument('last_name', InputArgument::OPTIONAL, 'Your last name?')
            ->addOption(
                'iterations',
                'i',
                InputOption::VALUE_OPTIONAL,
                'How many times should the message be printed?',
                1
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // // creates a new progress bar (50 units)
        // $progressBar = new ProgressBar($output, 100);
        //
        // // starts and displays the progress bar
        // $progressBar->start();

        // $i = 0;
        // while ($i++ < 100) {
        //     // ... do some work
        //
        //     // advances the progress bar 1 unit
        //     $progressBar->advance(5);
        //
        //     sleep(1);
        //
        //     if ($progressBar->getProgress() >= 100) {
        //         break;
        //     }
        //     // you can also advance the progress bar by more than 1 unit
        //     // $progressBar->advance(3);
        // }
        // $progressBar->finish();



        // $progressBar = new ProgressBar($output, 50);
        //
        // $progressBar->start();
        //
        // sleep(2);
        // // a complex task has just been created: increase the progressbar to 200 units
        // $progressBar->setMaxSteps(200);
        //
        // // ensures that the progress bar is at 100%
        // $progressBar->finish();



        // $progressBar = new ProgressBar($output);
        // $progressBar->start();
        //
        // $progressBar->clear();
        //
        // $output->writeln('Đang chạy tiến trình...');
        //
        // sleep(5);
        //
        // $progressBar->setMaxSteps(200);
        // $progressBar->display();
        // $progressBar->finish();



        // $progressBar = new ProgressBar($output);
        // $progressBar->setFormat('verbose');
        // $progressBar->setBarCharacter('<comment>=</comment>');
        // $progressBar->setEmptyBarCharacter(' ');
        // $progressBar->setProgressCharacter('|');
        // $progressBar->setBarWidth(50);
        //
        // // $iterable can be array
        // $iterable = range(1, 20);
        // foreach ($progressBar->iterate($iterable) as $value) {
        //     // ... do some work
        //     sleep(1);
        // }



        $section1 = $output->section();
        $section2 = $output->section();

        $progress1 = new ProgressBar($section1);
        $progress2 = new ProgressBar($section2);

        $progress1->start(100);
        $progress2->start(100);

        $i = 0;
        while (++$i < 100) {
            $progress1->advance();

            if ($i % 2 === 0) {
                $progress2->advance(4);
            }

            usleep(100000);
        }

        return Command::SUCCESS;
    }
}