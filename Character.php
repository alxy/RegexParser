<?php

class Character
{
	protected $value;

	public function __construct($value) {
		$this->setValue($value);
	}

	/**
	 * Getter for value
	 *
	 * @return string
	 */
	public function getValue()
	{
	    return $this->value;
	}
	
	/**
	 * Setter for value
	 *
	 * @param string $value Value to set
	 * @return self
	 */
	public function setValue($value)
	{
	    $this->value = $value;
	    return $this;
	}
	
}