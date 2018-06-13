# Algorithm W in PHP [![Build Status](https://travis-ci.org/widmogrod/php-algorithm-w.svg?branch=master)](https://travis-ci.org/widmogrod/php-algorithm-w)
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

## References
- `[1]` [Algorithm W Step by Step](https://github.com/mgrabmueller/AlgorithmW)
- `[2]` [php-functional](https://github.com/widmogrod/php-functional)
