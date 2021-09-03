<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'create';

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
        )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))


        // if (!$output instanceof ConsoleOutputInterface) {
        //     throw new \LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        // }

        // $section1 = $output->section();
        // $section2 = $output->section();

        // $section1->writeln('Hello');
        // $section2->writeln('World!');
        // // Output displays "Hello\nWorld!\n"

        // // overwrite() replaces all the existing section contents with the given content
        // $section1->overwrite('Goodbye');
        // // Output now displays "Goodbye\nWorld!\n"

        // // clear() deletes all the section contents...
        // $section2->clear();
        // // Output now displays "Goodbye\n"

        // // ...but you can also delete a given number of lines
        // // (this example deletes the last two lines of the section)
        // $section1->clear(2);
        // // Output is now completely empty!



        // $text = 'Hi ';

        // $names = $input->getArgument('names');
        // if (count($names) > 0) {
        //     $text .= ' '.implode(', ', $names);
        // }



        $text = 'Hi '.$input->getArgument('name');

        // $lastName = $input->getArgument('last_name');
        // if ($lastName) {
        //     $text .= ' '.$lastName;
        // }

        // $output->writeln($text.'!');

        for ($i = 0; $i < $input->getOption('iterations'); $i++) {
            $output->writeln($text);
        }


        // outputs multiple lines to the console (adding "\n" at the end of each line)
        // $output->writeln([
        //     'User Creator',
        //     '============',
        //     '',
        // ]);

        // the value returned by someMethod() can be an iterator (https://secure.php.net/iterator)
        // that generates and returns the messages with the 'yield' PHP keyword
        // $output->writeln($this->someMethod());

        // outputs a message followed by a "\n"
        // $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        // $output->write('You are about to ');
        // $output->write('create a user.');


        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID;
    }
}
