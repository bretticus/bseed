<?php

namespace BambooSeeder\Libraries;

/**
 * Description of RendererInterface
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
interface RendererInterface {

	/**
	 *
	 * @param array $records
	 */
	public function setRecords(array $records);

	/**
	 * @return mixed
	 */
	public function render();
}
