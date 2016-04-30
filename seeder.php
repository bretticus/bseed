<?php

use BambooSeeder\Commands\CsvCommand;
use Symfony\Component\Console\Application;
require __DIR__ . '/vendor/autoload.php';
$application = new Application();
$application->add(new CsvCommand());
$application->run();