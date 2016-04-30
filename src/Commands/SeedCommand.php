<?php

namespace BambooSeeder\Commands;

use BambooSeeder\Libraries\Engine;
use BambooSeeder\Libraries\RendererFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of CsvCommand
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class SeedCommand extends Command {

	/**
	 *
	 */
	protected function configure() {
		$this->setName('seed')
				->setDescription('Generate Seed Data')
				->addArgument(
						'number', InputArgument::OPTIONAL, 'How many seed records do you want to generate?', 10
				)->addOption(
				'filename', 'f', InputOption::VALUE_OPTIONAL, 'If set, the output will be written to filename instead of standard output.'
		)->addOption(
				'type', 't', InputOption::VALUE_OPTIONAL, 'For now, we only support the csv type', 'csv'
		);
	}

	/**
	 *
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
		$number = $input->getArgument('number');
		$fileName = $input->getOption('filename');
		$type = $input->getOption('type');
		$renderer = RendererFactory::create($type);
		$records = Engine::render($number);
		$renderer->setRecords($records);
		$out = $renderer->render();
		if (!file_exists($fileName) && is_writable($fileName)) {
			file_put_contents($fileName, $out);
			$output->writeln('<info>Wrote outout to ' . $fileName . '</info>');
		} else {
			$output->write($out);
		}
	}

}
