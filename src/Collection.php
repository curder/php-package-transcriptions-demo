<?php

namespace Curder\PhpPackageTranscriptionsDemo;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * Class Collection
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Collection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function map(callable $fn): self
    {
        return new static(
            array_map($fn, $this->items)
        );
    }

    public function jsonSerialize()
    {
        return $this->items;
    }

    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetExists($key): bool
    {
        return isset($this->items[ $key ]);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function count(): int
    {
        return count($this->items);
    }
}
