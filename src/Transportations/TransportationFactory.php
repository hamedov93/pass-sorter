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

		if (!isset($data['type'], $data['number'], $data['from'], $data['to'])) {
			throw new RuntimeException('Please provide type, number, from and to fields for all transportations');
		}

		return new $className($data);
	}
}
