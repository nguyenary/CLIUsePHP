#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('Nguyen Ary Console', 'v1.0 (stable)');

$application->add(new \App\Command\CreateUserCommand());

$application->run();
