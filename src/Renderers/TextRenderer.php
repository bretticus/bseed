<?php

namespace BambooSeeder\Renderers;

use BambooSeeder\Libraries\RendererInterface;

/**
 * Description of TextRenderer
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class TextRenderer implements RendererInterface {

	private $records = [];

	public function render() {
		ob_start();
		foreach ($this->records as $row) {
			echo implode("\t", $row) . PHP_EOL;
		}
		return ob_get_clean();
	}

	/**
	 * 
	 * @param array $records
	 */
	public function setRecords(array $records) {
		$this->records = $records;
	}

}
