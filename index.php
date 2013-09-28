<?php

function __autoload($class_name) {
    require $class_name . '.php';
}



$regex = '([abc]*|d|(b|(c|d))+(abc){2,3}';
#$regex = '[0-9]+';
/*
$quants = '+';

$tokens = <<<'TOKENS'
/\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./
TOKENS;

$quantifier = <<<'QUANTIFIER'
/^(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??$/
QUANTIFIER;

$characterClass = <<<'CHARCLASS'
/[^\\-]+|-|\\(?:[0-3][0-7]{0,2}|[4-7][0-7]?|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)/
CHARCLASS;

preg_match_all($tokens, $regex, $result);
preg_match_all('/\d+|,/', '{123,34}', $result2);
#preg_match_all($quantifier, $quants, $result);

echo '<pre>';
var_dump($result);
echo '</pre>';
echo '<pre>';
var_dump($result2[0]);
echo '</pre>';
*/


$parser = new RegexParser($regex);
var_dump($parser->parse());
