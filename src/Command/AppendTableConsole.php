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

class AppendTableConsole extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'test1';

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
        $text = 'Hi ' . $input->getArgument('name') . ' ' . $input->getArgument('last_name');

        for ($i = 0; $i < $input->getOption('iterations'); $i++) {
            $output->writeln($text);
        }

        // Thêm hiển thị dang table ra terminal
        $section = $output->section();
        $table = new Table($section);

        $table->addRow(['Love']);
        $table->render();

        sleep(2);

        $table->appendRow(['Symfony']);

        sleep(2);

        $table->appendRow(['Symfony 2']);

        sleep(2);

        $table->appendRow(['Symfony 3']);

        return Command::SUCCESS;
    }
}