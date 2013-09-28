<?php

class Quantifier
{
	/**
	 * Minimal amount of characters
	 * @var integer
	 */
	protected $minimum;
	/**
	 * Maximal amount of characters, -1 if infinite
	 * @var integer
	 */
	protected $maximum;

	public function __construct($minimum, $maximum) {
		$this->setMinimum($minimum);
		$this->setMaximum($maximum);
	}

	/**
	 * Getter for minimum
	 *
	 * @return integer
	 */
	public function getMinimum()
	{
	    return $this->minimum;
	}
	
	/**
	 * Setter for minimum
	 *
	 * @param integer $minimum Value to set
	 * @return self
	 */
	public function setMinimum($minimum)
	{
	    $this->minimum = $minimum;
	    return $this;
	}
	
	/**
	 * Getter for maximum
	 *
	 * @return integer
	 */
	public function getMaximum()
	{
	    return $this->maximum;
	}
	
	/**
	 * Setter for maximum
	 *
	 * @param integer $maximum Value to set
	 * @return self
	 */
	public function setMaximum($maximum)
	{
	    $this->maximum = $maximum;
	    return $this;
	}
	
}