# Parsing with Derivatives

A simple Parser based upon the work of Matthew Might and David Darais.
The Papers implemented are:
1) http://matt.might.net/papers/might2011derivatives.pdf
2) http://leifandersen.net/papers/andersen2012parsing.pdf

In short:

the Parser uses derivatives to match a Language.
For Example the Derivative of a Language that accepts L={ab} with respect to the Character a
is D<sub>a</sub>(L) = {b}


## Testcases

I added some simple Testcases. For example to parse the language expressed with 
the regular Expression : "ab*", parse it like:
```PHP
    $L = new Union(new Character("b"),new Star(new Character("a"))); 
    assert(Parser::matches("baaa", $L) == true);
```

## Things not implemented

1) Memoization
2) Fixed Points

## License

Its licensed under WTFPL 
https://de.wikipedia.org/wiki/WTFPL

