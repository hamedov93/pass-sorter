<?php

namespace Hamedov\PassSorter\Contracts;

/**
 * The contract that needs to be implemented by all sorting classes
 */
interface SortInterface
{
	/**
	 * Sorts given boardings
	 * @param  array  $boardings
	 * @return array
	 */
	public function sort(array $boardings): array;
}
