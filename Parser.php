<?php

/**
 * Parsing with derivatives PHP
 * based upon http://leifandersen.net/papers/andersen2012parsing.pdf
 * made by Tom 2017
 */
Interface LanguageComponent
{
}

class EmptyL implements LanguageComponent
{
}

class Epsilon implements LanguageComponent
{
}

class Character implements LanguageComponent
{
    var $c;

    function __construct($c) { $this->c = $c; }
}

class Cat implements LanguageComponent
{
    var $L1;
    var $L2;

    function __construct(LanguageComponent $L1, LanguageComponent $L2)
    {
        $this->L1 = $L1;
        $this->L2 = $L2;
    }
}

class Union implements LanguageComponent
{
    var $L1;
    var $L2;

    function __construct(LanguageComponent $L1, LanguageComponent $L2)
    {
        $this->L1 = $L1;
        $this->L2 = $L2;
    }
}

class Star implements LanguageComponent //kleene star concetenation
{
    var $L;

    function __construct(LanguageComponent $L)
    {
        $this->L = $L;
    }
}

class Parser
{
    public static function nullability(LanguageComponent $L)
    {
        if ($L instanceof EmptyL)
            return False;
        if ($L instanceof Epsilon)
            return True;
        if ($L instanceof Character)
            return False;
        if ($L instanceof Star)
            return True;
        if ($L instanceof Union)
            return self::nullability($L->L1) || self::nullability($L->L2);
        if ($L instanceof Cat)
            return self::nullability($L->L1) && self::nullability($L->L2);
    }

    public static function derive($c, $L)
    {
        if ($L instanceof EmptyL) return new EmptyL();
        if ($L instanceof Epsilon) return new EmptyL();
        if ($L instanceof Character) {
            if (strcmp($c, $L->c) == 0)
                return new Epsilon();
            else
                return new EmptyL();
        }
        if ($L instanceof Union)
            return new Union(self::derive($c, $L->L1), self::derive($c, $L->L2));
        if ($L instanceof Cat) {
            if (self::nullability($L->L1)) return new Union(self::derive($c, $L->L2), new Cat(self::derive($c, $L->L1), $L->L2));
            else return new Cat(self::derive($c, $L->L1), $L->L2);
        }
        if ($L instanceof Star)
            return new Cat(self::derive($c, $L->L), $L);
    }

    public static function matches($w, LanguageComponent $L)
    {
        if ($w == "") return self::nullability($L);
        else return self::matches(substr($w, 1), self::derive(substr($w, 0, 1), $L));
    }
}

