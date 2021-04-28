<?php

namespace Hamedov\PassSorter;

use Hamedov\PassSorter\Transportations\TransportationFactory;

/**
 * Main Pass class
 * represents the full path with all its boardings
 */
class Pass
{
	/**
	 * All checkpoints of the journey unsorted
	 * @var array
	 */
	private $boardings;

	/**
	 * Sorting result
	 * @var array
	 */
	private $result;

	/**
	 * Construct a new path instance with its boardings
	 * @param array $boardings
	 */
	public function __construct(array $boardings)
	{
		$this->boardings = $boardings;
	}

	/**
	 * Sort the boardings and store the result
	 * @return array
	 */
	public function sort(): void
	{
		$this->result = $this->boardings;
		return;
	}

	/**
	 * Get the result of sort
	 * @return array|null
	 */
	public function getResult(): ?array
	{
		return $this->result;
	}

	public function isSorted()
	{
		return $this->result != null;
	}

	public function output(): void
	{
		$stops = array_map(function($stop, $index) {
			$transportation = TransportationFactory::create((array) $stop);
			return $index . '. ' . $transportation;
		}, $this->result, array_keys($this->result));

		$outputString = implode("\r\n", $stops);

		echo $outputString . "\r\n";
	}
}
