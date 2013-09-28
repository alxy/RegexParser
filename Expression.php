<?php

abstract class Expression extends ArrayObject
{
	protected $quantifier;

	/**
	 * Getter for quantifier
	 *
	 * @return Quantifier
	 */
	public function getQuantifier()
	{
	    return $this->quantifier;
	}
	
	/**
	 * Setter for quantifier
	 *
	 * @param Quantifier $quantifier Value to set
	 * @return self
	 */
	public function setQuantifier(Quantifier $quantifier)
	{
	    $this->quantifier = $quantifier;
	    return $this;
	}
}