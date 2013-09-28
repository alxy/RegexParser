<?php

class QuantifierFactory
{
	public function fromConstant($constant) {
		switch ($constant) {
			case '*':
				return new Quantifier(0, -1);
				break;
			case '?':
				return new Quantifier(0, 1);
				break;
			case '+':
				return new Quantifier(1, -1);
				break;
			default:
				throw new Exception('Unknown quantifier');
				break;
		}
	}
}