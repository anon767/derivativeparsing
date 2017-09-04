<?php
/**
 * @project: derivativesparsing
 * @package:
 * @author: T
 * @date: 01.09.2017
 */
require_once "./Parser.php";

$L = new Character("a");
assert(Parser::matches("a", $L) == true); // a
$L = new Union(new Character("a"),new Character("b")); //ab
assert(Parser::matches("ab", $L) == true);
$L = new Union(new Character("c"),new Character("b")); //cb
assert(!Parser::matches("ab", $L) == true);
$L = new Cat(new Character("b"),new Star(new Character("a"))); //ba*
assert(Parser::matches("baaa", $L) == true);

echo "tests succeeded";