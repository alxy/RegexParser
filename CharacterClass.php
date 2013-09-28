<?php

class CharacterClass
{
	protected $characters = array();

	public function __construct($characters = array()) {
		$this->characters = $characters;
	}

	/**
	 * Getter for characters
	 *
	 * @return array
	 */
	public function getCharacters()
	{
	    return $this->characters;
	}
	
	/**
	 * Setter for character
	 *
	 * @param Character $character Value to set
	 * @return self
	 */
	public function addCharacter(Character $character)
	{
	    $this->characters[] = $character;
	    return $this;
	}
	
}