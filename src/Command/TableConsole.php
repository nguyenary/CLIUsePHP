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

class TableConsole extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'test';

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
        $table = new Table($output);
        $table
            ->setHeaders(['ISBN', 'Title', 'Author'])
            ->setRows([
                ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
                new TableSeparator(),
                ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
                new TableSeparator(),
                ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
                new TableSeparator(),
                ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
                new TableSeparator(),
                [new TableCell('Main table title', ['colspan' => 3])],
            ]);
        // $table->setHeaderTitle('Books');
        // $table->setFooterTitle('Page 1/2');
        // $table->setColumnWidth(0, 10);
        // $table->setColumnMaxWidth(0, 10);
        // $table->setStyle('box');

        $table->render();

        return Command::SUCCESS;
    }
}