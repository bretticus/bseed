<?php

namespace BambooSeeder\Libraries;

use Exception;

/**
 * Description of RendererFactory
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class RendererFactory {

	/**
	 * 
	 * @param string $type
	 * @return RendererInterface
	 * @throws Exception
	 */
	public static function create($type) {
		$class = 'BambooSeeder\\Libraries\\' . ucfirst(strtolower($type)) . 'Renderer';
		if (!class_exists($class)) {
			throw new Exception('Missing renderer class: ' . $class);
		}
		return new $class;
	}

}
