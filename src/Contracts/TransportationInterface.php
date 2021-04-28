<?php

namespace Hamedov\PassSorter\Contracts;

/**
 * Transportation contract
 * Each transportation must implement this interface
 */
interface TransportationInterface
{
	/**
	 * Get transportation data
	 * @return array
	 */
	public function getData(): array;

	/**
	 * Set single transportation property
	 * @param string $property
	 * @param mixed $value
	 */
	public function setProperty(string $property, $value): void;

	/**
	 * Get onboarding instructions for the transportation
	 * @return string
	 */
	public function getInstructions(): string;
}
