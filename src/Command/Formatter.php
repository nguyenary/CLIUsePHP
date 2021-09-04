<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Formatter extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'test3';

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
        $formatter = $this->getHelper('formatter');

        $formattedLine = $formatter->formatSection(
            'SomeSection',
            'Here is some message related to that section'
        );

        $output->writeln($formattedLine);

        $errorMessages = ['Error!', 'Something went wrong'];
        $formattedBlock = $formatter->formatBlock($errorMessages, 'error');
        $output->writeln($formattedBlock);

        // green text
        $output->writeln('<info>foo</info>');

        // yellow text
        $output->writeln('<comment>foo</comment>');

        // black text on a cyan background
        $output->writeln('<question>foo</question>');

        // white text on a red background
        $output->writeln('<error>foo</error>');

        // Tự set color
        $outputStyle = new OutputFormatterStyle('red', '#ff0', ['bold', 'blink']);
        $output->getFormatter()->setStyle('fire', $outputStyle);

        $output->writeln('<fire>foo</>');

        $outputStyle = new OutputFormatterStyle('white', '#007aff', ['bold', 'blink']);
        $output->getFormatter()->setStyle('test', $outputStyle);

        $output->writeln('<test> foo </>');

        // green text
        $output->writeln('<fg=green>foo</>');

        // red text
        $output->writeln('<fg=#c0392b>foo</>');

        // black text on a cyan background
        $output->writeln('<fg=black;bg=cyan>foo</>');

        // bold text on a yellow background
        $output->writeln('<bg=yellow;options=bold>foo</>');

        // bold text with underscore
        $output->writeln('<options=bold,underscore>foo</>');

        $message = "This is a very long message, which should be truncated";
        $truncatedMessage = $formatter->truncate($message, 15);
        $output->writeln($truncatedMessage);

        $output->writeln('<href=https://symfony.com>Symfony Homepage</>');

        return Command::SUCCESS;
    }
}