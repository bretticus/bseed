<?php

namespace BambooSeeder\Renderers;

use BambooSeeder\Libraries\RendererInterface;
use Symfony\Component\Console\Exception\RuntimeException;

/**
 * Description of CsvRenderer
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class CsvRenderer implements RendererInterface {

	private $records = [];

	/**
	 * 
	 * @return string
	 * @throws RuntimeException
	 */
	public function render() {
		// output up to 5MB is kept in memory, if it becomes bigger it will automatically be written to a temporary file
		$out = fopen('php://temp/maxmemory:' . (5 * 1024 * 1024), 'r+');
		if ($out === false) {
			throw new RuntimeException('Failed to open temporary file');
		}
		foreach ($this->records as $row) {
			fputcsv($out, $row);
		}
		rewind($out);
		$output = stream_get_contents($out);
		fclose($out);
		return $output;
	}

	/**
	 * 
	 * @param array $records
	 */
	public function setRecords(array $records) {
		$this->records = $records;
	}

}
