<?php

namespace Hamedov\PassSorter;

/**
 * PassSorter module singleton class
 */
class PassSorter
{
	private static $instance = null;

	public static $supportedTransportations = [
		'bus', 'train', 'airplane',
	];

	/**
	 * Prevent initialization from outer code
	 */
	private function __construct()
	{

	}

	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new PassSorter;
		}

		return self::$instance;
	}
}
