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
	 * @var array Restrict possible types
	 */
	public static $types = ['csv', 'text', 'json', 'xml'];

	/**
	 *
	 * @param string $type
	 * @return RendererInterface
	 * @throws Exception
	 */
	public static function create($type) {
		$typeValidated = in_array($type, static::$types) ? $type : static::$types[0];
		$class = 'BambooSeeder\\Renderers\\' . ucfirst(strtolower($typeValidated)) . 'Renderer';
		if (!class_exists($class)) {
			throw new Exception('Missing renderer class: ' . $class);
		}
		return new $class;
	}

}
