<?php

class Tokenizer
{

	private static $pattern = <<<'TOKENS'
/\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./
TOKENS;
	protected $regex;
	protected $tokens;

	public function __construct($regex) {
		$this->regex = $regex;
	}

	public function tokenize() {
		preg_match_all(static::$pattern, $this->regex, $tokens);
		$this->tokens = new ArrayObject($tokens[0]);
		return $this;
	}

	public function getTokens() {
		return $this->tokens;
	}

}