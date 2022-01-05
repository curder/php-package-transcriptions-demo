<?php

namespace Curder\PhpPackageTranscriptionsDemo;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Class Lines
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Lines implements Countable, IteratorAggregate
{
    protected array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    public function asHtml(): string
    {
        $formattedLines = array_map(
            static fn (Line $line) => $line->toAnchorTag(),
            $this->lines,
        );

        return (new static($formattedLines))->__toString();
    }

    public function count(): int
    {
        return count($this->lines);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->lines);
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->lines);
    }
}
