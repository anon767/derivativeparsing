<?php
/**
 * @project: derivativesparsing
 * @package:
 * @author: T
 * @date: 01.09.2017
 */
require_once "./Parser.php";

$L = new Character("a");
assert(Parser::matches("a", $L)); // a
$L = new Cat(new Character("a"),new Character("b")); //ab
assert(Parser::matches("ab", $L));
$L = new Union(new Character("a"),new Character("b")); //a|b
assert(Parser::matches("a", $L) && Parser::matches("b", $L));
$L = new Cat(new Union(new Character("a"),new Character("b")),new Character("c")); //(a|b)c
assert(Parser::matches("ac",$L) && Parser::matches("bc",$L));
$L = new Star(new Character("a")); // a*
assert(Parser::matches("aaaaaaaaaaaaaaaaaaaaaa", $L));
echo "tests done";