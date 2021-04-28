<?php

namespace Hamedov\PassSorter;

use Hamedov\PassSorter\Transportations\TransportationFactory;
use Hamedov\PassSorter\Sorts\DefaultSort;

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
	 * Sorter class used to sort boardings
	 * @var \Hamedov\PassSorter\Contracts\SortInterface
	 */
	private $sorter;

	/**
	 * Construct a new path instance with its boardings
	 * @param array $boardings
	 */
	public function __construct(array $boardings)
	{
		$this->boardings = array_map(function($boarding) {
			return TransportationFactory::create((array) $boarding);
		}, $boardings);

		$this->sorter = new DefaultSort;
	}

	/**
	 * Sort the boardings and store the result
	 * @return array
	 */
	public function sort(): self
	{
		if (!empty($this->boardings)) {
			$this->result = $this->sorter->sort($this->boardings);
		}

		return $this;
	}

	/**
	 * Get the result of sort
	 * @return array|null
	 */
	public function getResult(): ?array
	{
		return $this->result;
	}

	/**
	 * Returns whether the pass has been sorted or not
	 * @return boolean
	 */
	public function isSorted(): bool
	{
		return $this->result != null;
	}

	/**
	 * Out sorting result as string
	 * @return void
	 */
	public function output(): void
	{
		if (empty($this->result)) {
			return;
		}

		$transportations = array_map(function($transportation, $index) {
			return $index . '. ' . $transportation;
		}, $this->result, array_keys($this->result));

		$outputString = implode("\r\n", $transportations);

		echo $outputString . "\r\n";
	}
}
