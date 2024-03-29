<?php

namespace BambooSeeder\Commands;

use BambooSeeder\Libraries\Engine;
use BambooSeeder\Libraries\RendererFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\RuntimeException;
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
	 * Configure paramters for command
	 */
	protected function configure() {
		$this->setName('seed')
				->setDescription('Generate Seed Data')
				->addArgument('number', InputArgument::OPTIONAL, 'How many seed records do you want to generate?', 10)
				->addOption('fileout', 'f', InputOption::VALUE_OPTIONAL, 'If set, the output will be written to file name specified instead of standard output.')
				->addOption('suppress-headers', null, InputOption::VALUE_NONE, 'If set, headers will not be written as the first row of results.')
				->addOption('type', 't', InputOption::VALUE_OPTIONAL, 'Format [' . implode(',', RendererFactory::$types) . ']', RendererFactory::$types[0]);
	}

	/**
	 *
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int
	 * @throws \Exception
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
		$number = $input->getArgument('number');
		$fileName = $input->getOption('fileout');
		$type = $input->getOption('type');
		$supressHeaders = $input->getOption('suppress-headers');
		$renderer = RendererFactory::create($type);
		$records = Engine::render($number, $supressHeaders);
		$renderer->setRecords($records);
		$out = $renderer->render();
		if (null !== $fileName) {
			if (file_exists($fileName)) {
				throw new RuntimeException($fileName . ' already exists. Cowardly refusing to overwrite.');
			}
			if (!is_writable(dirname($fileName))) {
				throw new RuntimeException('Cannot write to the parent directory: "' . dirname($fileName) . '"');
			}
			file_put_contents($fileName, $out);
			$output->writeln('<info>Wrote output to ' . $fileName . '</info>');
		} else {
			$output->write($out);
		}
		return 0;
	}

}
