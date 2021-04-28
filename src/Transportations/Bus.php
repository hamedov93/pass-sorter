<?php

namespace Hamedov\PassSorter\Transportations;

/**
 * Bus transportation class
 */
class Bus extends Transportation
{
	/**
	 * Get onboarding instructions for transportation
	 * @return string
	 */
	public function getInstructions(): string
	{
		$instructions = 'Take the ' . $this->number . ' bus from ' .
			$this->from . ' to ' . $this->to . '.';

		if ($this->seat != null) {
			$instructions .= ' Sit in seat ' . $this->seat . '.';
		}

		return $instructions;
	}
}
