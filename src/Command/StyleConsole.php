<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StyleConsole extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'test7';

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
        $io = new SymfonyStyle($input, $output);
        $io->title('Lorem Ipsum Dolor Sit Amet 11');

        $output->writeln([
            '<info>Lorem Ipsum Dolor Sit Amet</>',
            '<comment>Lorem Ipsum Dolor Sit Amet</>',
            '',
        ]);

        $io->section('Adding a User');

        $output->writeln('Hiển thị xem thử thế nào');

        $io->text([
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
            'Aenean sit amet arcu vitae sem faucibus porta',
        ]);

        $io->listing([
            'Element #1 Lorem ipsum dolor sit amet',
            'Element #2 Lorem ipsum dolor sit amet',
            'Element #3 Lorem ipsum dolor sit amet',
        ]);

        $io->table(
            ['Header 1', 'Header 2'],
            [
                ['Cell 1-1', 'Cell 1-2'],
                ['Cell 2-1', 'Cell 2-2'],
                ['Cell 3-1', 'Cell 3-2'],
            ]
        );

        $io->horizontalTable(
            ['Header 1', 'Header 2'],
            [
                ['Cell 1-1', 'Cell 1-2'],
                ['Cell 2-1', 'Cell 2-2'],
                ['Cell 3-1', 'Cell 3-2'],
            ]
        );

        $io->definitionList(
            'This is a title',
            ['foo1' => 'bar1'],
            ['foo2' => 'bar2'],
            ['foo3' => 'bar3'],
            new TableSeparator(),
            'This is another title',
            ['foo4' => 'bar4']
        );

        // use simple strings for short notes
        $io->note('Lorem ipsum dolor sit amet');


        // consider using arrays when displaying long notes
        $io->note([
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
            'Aenean sit amet arcu vitae sem faucibus porta',
        ]);

        // use simple strings for short caution message
        $io->caution('Lorem ipsum dolor sit amet');

        // consider using arrays when displaying long caution messages
        $io->caution([
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
            'Aenean sit amet arcu vitae sem faucibus porta',
        ]);

        // displays a progress bar of unknown length
        $io->progressStart();

        // displays a 100-step length progress bar
        $io->progressStart(100);

        // advances the progress bar 1 step
        $io->progressAdvance();

        // advances the progress bar 10 steps
        $io->progressAdvance(10);

        $io->progressFinish();

        $name = $io->ask('What is your name?');
        $age = $io->ask('What is your name?');

        $output->writeln('Tên: '. $name);
        $output->writeln('Tuổi: '. $age);

        //
        // $io->ask('Number of workers to start', 1, function ($number) {
        //     if (!is_numeric($number)) {
        //         throw new \RuntimeException('You must type a number.');
        //     }
        //
        //     return (int) $number;
        // });
        //
        // $io->askHidden('What is your password?', function ($password) {
        //     if (empty($password)) {
        //         throw new \RuntimeException('Password cannot be empty.');
        //     }
        //
        //     return $password;
        // });
        //
        // $io->confirm('Restart the web server?');
        //
        // $io->choice('Select the queue to analyze', ['queue1', 'queue2', 'queue3']);

        // // use simple strings for short success messages
        // $io->success('Lorem ipsum dolor sit amet');
        //
        // // consider using arrays when displaying long success messages
        // $io->success([
        //     'Lorem ipsum dolor sit amet',
        //     'Consectetur adipiscing elit',
        // ]);
        //
        // // use simple strings for short info messages
        // $io->info('Lorem ipsum dolor sit amet');
        //
        // // consider using arrays when displaying long info messages
        // $io->info([
        //     'Lorem ipsum dolor sit amet',
        //     'Consectetur adipiscing elit',
        // ]);
        //
        // // use simple strings for short warning messages
        // $io->warning('Lorem ipsum dolor sit amet');
        //
        // // consider using arrays when displaying long warning messages
        // $io->warning([
        //     'Lorem ipsum dolor sit amet',
        //     'Consectetur adipiscing elit',
        // ]);
        //
        // // use simple strings for short error messages
        // $io->error('Lorem ipsum dolor sit amet');
        //
        // // consider using arrays when displaying long error messages
        // $io->error([
        //     'Lorem ipsum dolor sit amet',
        //     'Consectetur adipiscing elit',
        // ]);

        return Command::SUCCESS;
    }
}