<?php

namespace BambooSeeder\Renderers;

use BambooSeeder\Libraries\RendererInterface;

/**
 * Description of JsonRenderer
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class JsonRenderer implements RendererInterface {

	private $records = [];
	
	/**
	 * 
	 * @return string
	 */
	public function render() {
		return json_encode($this->records, JSON_PRETTY_PRINT);
	}

	/**
	 * 
	 * @param array $records
	 */
	public function setRecords(array $records) {
		$this->records = $records;
	}
	
}
