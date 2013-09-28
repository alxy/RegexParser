<?php

class RegexParser
{
	public $regex;

	public function __construct($regex) {
		$this->regex = $regex;
	}

	public function parse() {
		$tokenizer = new Tokenizer($this->regex);
		$parenthesesParser = new ParenthesesParser($tokenizer->tokenize()->getTokens());
		$tokens = $parenthesesParser->parse();
		var_dump($tokens);
		return $this->parseTokens($tokens);
	}

	private function parseTokens($tokens = array(), $quantifier = null) {
		if ($this->isOrGroup($tokens)) {
			// Or expression
			$expression = new OrExpression;
			$current = [];
			#foreach ($tokens as $key => $token) {
			while (list($key, $token) = each($tokens)) { 
				var_dump($token);
				if (is_array($token)) {
					$tokenA = $token;
					if (isset($tokens[$key+1]) && !is_array($tokens[$key+1]) && $this->isQuantifier($tokens[$key+1])) {
						$quantifier = $tokens[$key+1];
						unset($tokens[$key+1]);
					} else {
						$quantifier = null;
					}

					$expression->append($this->parseTokens($token, $quantifier));
					continue;
				}

				if ($token === '|') {
					$expression->append($this->parseTokens($current));
					$current = [];
					continue;
				}

				$current[] = $token;
			}
			if (!empty($current)) {
				$expression->append($this->parseTokens($current));
			}
		} else {
			// And expression
			$expression = new AndExpression;
			foreach ($tokens as $token) {
				if (!isset($partialExpression)) {
					$partialExpression = new PartialExpression;
					$partialExpression->setAllowed($this->parseToken($token));
				} else {
					if ($this->isQuantifier($token)) {
						$partialExpression->setQuantifier($this->parseQuantifier($token));
					} else {
						$partialExpression->setQuantifier(new Quantifier(1, 1));
					}
					$expression->append($partialExpression);
					unset($partialExpression);
				}
			}
			if (isset($partialExpression)) {
				$partialExpression->setQuantifier(new Quantifier(1, 1));
				$expression->append($partialExpression);
			}
		}
		if (isset($quantifier)) {
			$expression->setQuantifier($this->parseQuantifier($quantifier));
		} else {
			$expression->setQuantifier(new Quantifier(1, 1));
		}
		return $expression;
		
	}

	private function parseToken($token) {
		if ($this->isCharacterClass($token)) {
			return $this->parseCharacterClass($token);
		}
		if ($this->isConstant($token)) {
			return $this->parseConstant($token);
		}
		if ($this->isEscaped($token)) {
			return $this->parseEscaped($token);
		}
		return $this->parseCharacter($token);
	}

	private function isOrGroup($tokens = array()) {
		return in_array('|', $tokens);
	}

	private function isCharacterClass($token) {
		return preg_match('/\[.*\]/', $token);
	}

	private function isQuantifier($token) {
		return preg_match('/^(\*|\?|\+|\{.*\})$/', $token);
	}

	private function isConstant($token) {
		return in_array($token, ['.', '\\w', '\\d', '\\s']);
	} 

	private function isEscaped($token) {
		return $token[0] === '\\';
	}

	private function parseCharacterClass($token) {
		$negative = $token[1] === '^';
		$characterClassFactory = new CharacterClassFactory();
		$characterClass = ($negative) ? $characterClassFactory->any() : new CharacterClass();

		preg_match_all('/(?!(?<=\[)\^)(\^|.-.|\\\\.|[^][])/', $token, $parts);

		foreach ($parts[0] as $part) {
			switch (strlen($part)) {
				case 1:
					$class = $characterClassFactory->fromArray([$part]);
					break;
				case 2:
					$class = $characterClassFactory->fromConstant($part);
					break;
				case 3:
					$class = $characterClassFactory->range($part[0], $part[2]);
					break;
				default:
					throw new Exception('Invalid CharacterClass syntax.');
					break;
			}
			$characterClass = ($negative) ? $characterClassFactory->differ($characterClass, $class) : $characterClassFactory->combine($characterClass, $class);
		}

		return $characterClass;
	}

	private function parseQuantifier($token) {
		$quantifierFactory = new QuantifierFactory();
		if (strlen($token) === 1) {
			return $quantifierFactory->fromConstant($token);	
		} else {
			preg_match_all('/\d+|,/', $token, $parts);
			$parts = $parts[0];
			switch (count($parts)) {
				case 1:
					return new Quantifier($parts[0], $parts[0]);
					break;
				case 2:
					return new Quantifier($parts[0], -1);
					break;
				case 3:
					return new Quantifier($parts[0], $parts[2]);
					break;			
				default:
					throw new Exception('Invalid Quantifier syntax');
					break;
			}
		}
	}

	private function parseConstant($token) {
		$characterClassFactory = new CharacterClassFactory();
		return $characterClassFactory->fromConstant($token);
	}

	private function parseEscaped($token) {
		return $this->parseCharacter($token[1]);
	}

	private function parseCharacter($token) {
		$characterClassFactory = new CharacterClassFactory();
		return $characterClassFactory->fromArray([$token]);
	}	
}