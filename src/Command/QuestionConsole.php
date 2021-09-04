<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Process\Process;

class QuestionConsole extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'test6';

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
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Continue with this action?', false, '/^(y|j)/i');

        $rep = $helper->ask($input, $output, $question);

        if (!$rep) {
            $output->writeln('Lỗi');
            return Command::FAILURE;
        }

        $output->writeln('Ban can cung cap them thong tin...');

        $question = new Question('Please enter the my name? ', 'Hoang');

        $name = $helper->ask($input, $output, $question);

        $output->writeln('<comment>Tên: ' . $name . '</comment>');

        $question = new ChoiceQuestion(
            'Please select your favorite color (defaults to red)',
            // choices can also be PHP objects that implement __toString() method
            ['red', 'blue', 'yellow'],
            0
        );
        $question->setErrorMessage('Color %s is invalid.');

        $color = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: '.$color);

        // Chọn nhiều màu. Phân tách nhau bằng dấu phẩy
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please select your favorite colors (defaults to red and blue)',
            ['red', 'blue', 'yellow'],
            '0,1'
        );
        $question->setMultiselect(true);

        $colors = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: ' . implode(', ', $colors));

        // Tự động hoàn thành câu trả lời
        $bundles = ['AcmeDemoBundle', 'AcmeBlogBundle', 'AcmeStoreBundle'];
        $question = new Question('Please enter the name of a bundle', 'FooBundle');
        $question->setAutocompleterValues($bundles);

        $bundleName = $helper->ask($input, $output, $question);

        $output->writeln('Autocomplete: ' . $bundleName);

        // Hàm gọi lại để tự động hoàn thành các đường dẫn
        // This function is called whenever the input changes and new
        // suggestions are needed.
        $callback = function (string $userInput): array {
            // Strip any characters from the last slash to the end of the string
            // to keep only the last directory and generate suggestions for it
            $inputPath = preg_replace('%(/|^)[^/]*$%', '$1', $userInput);
            $inputPath = '' === $inputPath ? '.' : $inputPath;

            // CAUTION - this example code allows unrestricted access to the
            // entire filesystem. In real applications, restrict the directories
            // where files and dirs can be found
            $foundFilesAndDirs = @scandir($inputPath) ?: [];

            return array_map(function ($dirOrFile) use ($inputPath) {
                return $inputPath.$dirOrFile;
            }, $foundFilesAndDirs);
        };

        $question = new Question('Please provide the full path of a file to parse');
        $question->setAutocompleterCallback($callback);

        $filePath = $helper->ask($input, $output, $question);

        // Câu trả lời cho người dùng nhập nhiều dòng
        $question = new Question('How do you solve world peace? ');
        $question->setMultiline(true);

        $answer = $helper->ask($input, $output, $question);

        // Ẩn câu trả lời để xử lý cho password
        $question = new Question('What is the database password?');
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        $password = $helper->ask($input, $output, $question);

         $output->writeln('Mật khẩu: ' . $password);

         // Validate câu trả lời của người dùng
        $question = new Question('Please enter the name of the bundle', 'AcmeDemoBundle');
        $question->setValidator(function ($answer) {
            if (!is_string($answer) || 'Bundle' !== substr($answer, -6)) {
                throw new \RuntimeException(
                    'The name of the bundle should be suffixed with \'Bundle\''
                );
            }

            return $answer;
        });

        // $question->setMaxAttempts(2);

        $bundleName = $helper->ask($input, $output, $question);

        return Command::SUCCESS;
    }
}