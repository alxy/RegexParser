<?php

class PartialExpression
{
	protected $allowed;
	protected $quantifier;

	/**
	 * Getter for allowed
	 *
	 * @return CharacterClass
	 */
	public function getAllowed()
	{
	    return $this->allowed;
	}
	
	/**
	 * Setter for allowed
	 *
	 * @param CharacterClass $allowed Value to set
	 * @return self
	 */
	public function setAllowed(CharacterClass $allowed)
	{
	    $this->allowed = $allowed;
	    return $this;
	}
	
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