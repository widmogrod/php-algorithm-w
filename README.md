# Algorithm W in PHP 
[![Build Status](https://travis-ci.org/widmogrod/php-algorithm-w.svg?branch=master)](https://travis-ci.org/widmogrod/php-algorithm-w) 
[![Maintainability](https://api.codeclimate.com/v1/badges/70bd6fed8962454e4c70/maintainability)](https://codeclimate.com/github/widmogrod/php-algorithm-w/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/70bd6fed8962454e4c70/test_coverage)](https://codeclimate.com/github/widmogrod/php-algorithm-w/test_coverage)

## Introduction
Algorithm W implemented in PHP based on Martin Grabmüller work [1].

Sneak peek of one of [many test cases](./src/AlgorithmW/AlgorithmWTest.php) can be interpreted
```php
'let id = (x -> let y = x in y) in id id ' => [
    'expression' => new ELet(
        'id',
        new EAbs(
            'x',
            new ELet(
                'y',
                new EVar('x'),
                new EVar('y')
            )
        ),
        new EApp(
            new EVar('id'),
            new EVar('id')
        )
    ),
    'expected' => '(a5 -> a5)',
],
```

The main goal of this project is to understand type interference.
After it, I can use gathered experience it the [typed-config](https://github.com/widmogrod/typed-config) project,
with is aiming to make configuration type safe, self-documenting, easy to extend and dead-simple to use.

## References
- `[1]` [Algorithm W Step by Step](https://github.com/mgrabmueller/AlgorithmW)
- `[2]` [php-functional](https://github.com/widmogrod/php-functional)
