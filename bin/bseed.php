<?php

use BambooSeeder\Commands\SeedCommand;
use Symfony\Component\Console\Application;

// Deals with installation inside /vendor or out.
foreach ([__DIR__ . '/../../../autoload.php', __DIR__ . '/../vendor/autoload.php'] as $file) {
	if (file_exists($file)) {
		require $file;
		break;
	}
}

$application = new Application();
$application->setName('bseed');
$application->setVersion('1.0.2');
$application->add(new SeedCommand());
$application->run();
