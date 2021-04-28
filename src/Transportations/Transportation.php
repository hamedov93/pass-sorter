<?php

namespace Hamedov\PassSorter\Transportations;

use Hamedov\PassSorter\Contracts\TransportationInterface;

/**
 * Abstract transportation class
 */
abstract class Transportation implements TransportationInterface
{
	/**
	 * Transportation means data as associative array
	 * @var array
	 */
	protected $data;

	/**
	 * Initialize transportation with its data
	 * @param array $data
	 */
	public function __construct(array $data)
	{
		$this->data = $data;
	}

	/**
	 * Get transportation data
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}

	/**
	 * Set single transportation property
	 * @param string $property
	 * @param mixed $value
	 */
	public function setProperty(string $property, $value): void
	{
		$this->data[$property] = $value;
	}

	/**
	 * Magic method for accessing transportation properties
	 * @param  string $property
	 * @return mixed
	 */
	public function __get(string $property)
	{
		if (array_key_exists($property, $this->data)) {
			return $this->data[$property];
		}

		$trace = debug_backtrace();
        trigger_error(
            'Undefined property ' . $property .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );

        return null;
	}

	/**
	 * Convert transportation object to its string equivalent
	 * in the final output
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->getInstructions();
	}
}
