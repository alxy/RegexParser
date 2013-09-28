<?php

class ParenthesesParser {
	protected $tokens;

	protected $stack = array();
	protected $current = array();

	public function __construct($tokens = array()) {
		$this->tokens = $tokens;
	}

	public function parse() {
		foreach ($this->tokens as $key => $token) {
			switch ($token) {
				case '(':
					array_push($this->stack, $this->current);
					$this->current = array();
					break;
				case ')':
					$current = $this->current;
					$this->current = array_pop($this->stack);
					$this->current[] = $current;
					break;			
				default:
					$this->current[] = $token;
					break;
			}
		}
		return $this->current;
	}
}