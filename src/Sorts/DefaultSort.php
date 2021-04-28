<?php

namespace Hamedov\PassSorter\Sorts;

use Hamedov\PassSorter\Contracts\SortInterface;

/**
 * Default sorting criteria
 * Can be swapped in favor other sorting methods
 * Which implement the SortInterface
 */
class DefaultSort implements SortInterface
{
	/**
	 * Boardings which remained to be sorted in the next recursive function call
	 * @var array
	 */
	private $unsorted;

	/**
	 * Sorted boardings
	 * @var array
	 */
	private $sorted;

	/**
	 * Sorts boardings and returns the result
	 * @param  array  $boardings
	 * @return array
	 */
	public function sort(array $boardings): array
	{
		// We will push boardings into the result array
		// each in its appropriate location
		if (empty($this->sorted)) {
			$this->sorted = [];
			$this->unsorted = [];
			$this->sorted[] = array_shift($boardings);
		}
		
		foreach ($boardings as $key => $boarding) {
			$from = reset($this->sorted)->from;
			$to = end($this->sorted)->to;
			if ($boarding->from === $to || $boarding->to === $from) {
				if ($boarding->from === $to) {
					array_push($this->sorted, $boarding);
				} elseif ($boarding->to === $from) {
					array_unshift($this->sorted, $boarding);
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

		return $this->sorted;
	}
}
