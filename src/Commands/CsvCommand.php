<?php

namespace BambooSeeder\Commands;

use BambooSeeder\Libraries\Engine;
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
class CsvCommand extends Command {

	protected function configure() {
		$this->setName('seed:csv')
				->setDescription('Generate CSV Output')
				->addArgument(
						'Number', InputArgument::OPTIONAL, 'How many seed records do you want to generate?'
				)->addOption(
				'Filename', null, InputOption::VALUE_NONE, 'If set, the CSV output will be written to filename instead of standard output.'
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$number = $input->getArgument('Number');
		$fileName = $input->getOption('Filename');
		$path = is_writable($fileName) ? $fileName : 'php://output';
		ob_start();
		$out = fopen($path, 'w');
		foreach (Engine::render($number) as $row) {
			fputcsv($out, $row);
		}
		fclose($out);
		$text = ob_get_clean();
		$output->writeln($text);
	}

}
