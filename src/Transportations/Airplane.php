<?php

namespace Hamedov\PassSorter\Transportations;

/**
 * Airplane transportation class
 */
class Airplane extends Transportation
{
	public function getInstructions(): string
	{
		$instructions = 'From ' . $this->from . ', take ' .
			$this->number . ' to ' . $this->to . '. Gate ' . $this->gate .
			', seat ' . $this->seat . '.';

		if ($this->counter != null) {
			$instructions .= ' Baggage drop at ticket counter ' . $this->counter . '.';
		} else {
			$instructions .= ' Baggage will be automatically transferred from your last leg.';
		}

		return $instructions;
	}
}
