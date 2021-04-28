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
		$this->boardings = array_map(function($boarding) {
			return TransportationFactory::create((array) $boarding);
		}, $boardings);
	}

	/**
	 * Sort the boardings and store the result
	 * @return array
	 */
	public function sort($boardings = null): self
	{
		$boardings = $boardings ?? $this->boardings;
		if (empty($boardings)) {
			return $this;
		}

		// We will push boardings into the result array
		// each in its appropriate location
		if (empty($this->result)) {
			$this->result = [];
			$this->unsorted = [];
			$this->result[] = array_shift($boardings);
		}
		
		foreach ($boardings as $key => $boarding) {
			$from = reset($this->result)->from;
			$to = end($this->result)->to;
			if ($boarding->from === $to || $boarding->to === $from) {
				if ($boarding->from === $to) {
					array_push($this->result, $boarding);
				} elseif ($boarding->to === $from) {
					array_unshift($this->result, $boarding);
				}

				if (isset($this->unsorted[$key])) {
					unset($this->unsorted[$key]);
				}
			} else {
				$this->unsorted[] = $boarding;
			}
		}

		if (!empty($this->unsorted)) {
			$this->sort($this->unsorted);
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
