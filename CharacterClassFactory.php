<?php

class CharacterClassFactory
{
	/**
	 * Representation: .
	 * @return CharacterClass
	 */
	public function any() {
		return $this->range(chr(0), chr(255));
	}

	/**
	 * Representation: \d
	 * @return CharacterClass 
	 */
	public function digits() {
		return $this->range(0, 9);
	}

	/**
	 * Representation: \s
	 * @return CharacterClass
	 */
	public function whitespace() {
		$characters = [chr(9), chr(10), chr(12), chr(13), chr(32)];
		return $this->fromArray($characters);
	}

	/**
	 * Representation: \w
	 * @return CharacterClass
	 */
	public function wordCharacter() {
		$alpha = $this->combine($this->range('a', 'z'), $this->range('A', 'Z'));
		$numeric = $this->combine($this->digits, $this->fromArray(['_']));
		$characters = $this->combine($alpha, $numeric);
		return new CharacterClass($characters);
	}

	public function range($from, $to) {
		$characters = range($from, $to);
		return $this->fromArray($characters);
	}

	public function combine(CharacterClass $a, CharacterClass $b) {
		$characters = array_merge($this->getValues($a), $this->getValues($b));
		return $this->fromArray($characters);
	}

	public function differ(CharacterClass $a, CharacterClass $b) {
		$characters = array_diff($this->getValues($a), $this->getValues($b));
		return $this->fromArray($characters);
	}

	public function fromConstant($constant) {
		switch ($constant) {
			case '\\d':
				return $this->digits();
				break;
			case '\\s':
				return $this->whitespace();
				break;
			case '\\w':
				return $this->whitespace();
				break;
			case '.':
				return $this->any();
				break;
			default:
				throw new Exception('Unknown constant');
				break;
		}
	}

	public function fromArray($characters = array()) {
		$array = [];
		foreach ($characters as $character) {
			$array[] = new Character($character);
		}
		return new CharacterClass($array);
	}

	private function getValues(CharacterClass $characterClass) {
		$characters = [];
		foreach ($characterClass->getCharacters() as $character) {
			$characters[] = $character->getValue();
		}
		return $characters;
	}

}