#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('Nguyen Ary Console', 'v1.0 (stable)');

$application->add(new \App\Command\CreateUserCommand());
$application->add(new \App\Command\TableConsole());
$application->add(new \App\Command\AppendTableConsole());
$application->add(new \App\Command\ProgressConsole());
$application->add(new \App\Command\Formatter());
$application->add(new \App\Command\ProcessConsole());
$application->add(new \App\Command\CursorConsole());
$application->add(new \App\Command\QuestionConsole());
$application->add(new \App\Command\StyleConsole());

$application->run();
