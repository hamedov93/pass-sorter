<?php

namespace Hamedov\PassSorter\Transportations;

/**
 * Train transportation class
 */
class Train extends Transportation
{
	/**
	 * Get onboarding instructions for transportation
	 * @return string
	 */
	public function getInstructions(): string
	{
		$instructions = 'Take train ' . $this->number . ' from ' .
			$this->from . ' to ' . $this->to . '.';

		if (!empty($this->seat)) {
			$instructions .= ' Sit in seat ' . $this->seat;
		}

		return $instructions;
	}
}
