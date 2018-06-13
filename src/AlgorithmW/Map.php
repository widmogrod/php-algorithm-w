<?php

declare(strict_types=1);

namespace AlgorithmW;

use Widmogrod\Monad\Maybe\Maybe;
use Widmogrod\Primitive\Listt;
use function Widmogrod\Functional\fromIterable;
use function Widmogrod\Functional\reduce;
use function Widmogrod\Monad\Maybe\just;
use function Widmogrod\Monad\Maybe\nothing;

class Map
{
    private $data;

    private function __construct(\ArrayObject $data)
    {
        $this->data = $data;
    }

    public static function mempty()
    {
        return new static(new \ArrayObject());
    }

    public static function elems(Map $map): Listt
    {
        return fromIterable(array_values($map->data->getArrayCopy()));
    }


    public static function keys(Map $map): Listt
    {
        return fromIterable(array_keys($map->data->getArrayCopy()));
    }

    public static function union(Map $a, Map $b): Map
    {
        return reduce(function (Map $acc, $key) use ($b) {
            return static::insert($key, $b->data[$key], $acc);
        }, $a, static::keys($b));
    }

    public static function map(callable $fn, Map $map): Map
    {
        return reduce(function (Map $acc, $key) use ($fn, $map) {
            return static::insert($key, $fn($map->data[$key]), $acc);
        }, static::mempty(), static::keys($map));
    }

    public static function lookup($key, Map $map): Maybe
    {
        return isset($map->data[$key])
            ? just($map->data[$key])
            : nothing();
    }

    public static function delete($key, Map $map): Map
    {
        if (isset($map->data[$key])) {
            $new = clone $map->data;
            unset($new[$key]);

            return new static($new);
        }

        return $map;
    }

    public static function insert($key, $value, Map $map): Map
    {
        $new = clone $map->data;
        $new[$key] = $value;

        return new static($new);
    }

    public static function fromList(Listt $list)
    {
        return reduce(function (Map $acc, $tuple) {
            [$key, $value] = $tuple;

            return static::insert($key, $value, $acc);
        }, static::mempty(), $list);
    }

    public static function singleton($u, $t)
    {
        return static::insert($u, $t, static::mempty());
    }
}
