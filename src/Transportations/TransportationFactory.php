<?php

namespace Hamedov\PassSorter\Transportations;

use Exception\RuntimeException;

/**
 * Transportation factory class used to create
 * transportation instances
 */
class TransportationFactory
{
	public static function create(array $data)
	{
		$className = '\Hamedov\PassSorter\Transportations\\' . ucfirst($data['type']);
		if (!class_exists($className)) {
			throw new RuntimeException('The provided transportation is not supported.');
		}

		return new $className($data);
	}
}
