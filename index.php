<?php

function __autoload($class_name) {
    require $class_name . '.php';
}



$regex = '([abc]*|d|(b|(c|d))+(abc){2,3}';
// $regex = '[0-9]+';


$parser = new RegexParser($regex);
var_dump($parser->parse());
