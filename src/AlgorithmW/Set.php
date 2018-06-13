<?php

declare(strict_types=1);

namespace AlgorithmW;

use function Widmogrod\Functional\concatM;
use function Widmogrod\Functional\fromIterable;
use function Widmogrod\Functional\reduce;
use Widmogrod\Primitive\Listt;

class Set
{
    const union = 'AlgorithmW\\Set::union';

    private $data;

    private function __construct(\ArrayObject $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritdoc
     */
    public static function mempty()
    {
        return new static(new \ArrayObject());
    }

    public static function fromList(Listt $l)
    {
        return reduce(function (Set $acc, $value) {
            return $acc::insert($value, $acc);
        }, static::mempty(), $l);
    }

    public static function toList(Set $set): Listt
    {
        return fromIterable(array_keys($set->data->getArrayCopy()));
    }

    public static function withValue($n): Set
    {
        return new static(new \ArrayObject([
            $n => true,
        ]));
    }

    public static function insert($value, Set $set): Set
    {
        $new = clone $set->data;
        $new[$value] = true;

        return new static($new);
    }

    public static function union(Set $a, Set $b): Set
    {
        return self::fromList(concatM(
            static::toList($a),
            static::toList($b)
        ));
    }

    public static function difference(Set $a, Set $b): Set
    {
        return reduce(function (Set $acc, $value) use ($b) {
            return static::member($value, $b)
                ? $acc
                : static::insert($value, $acc);
        }, static::mempty(), static::toList($a));
    }

    public static function member($value, Set $set): bool
    {
        return isset($set->data[$value]);
    }
}
