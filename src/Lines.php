<?php

namespace Curder\PhpPackageTranscriptionsDemo;

/**
 * Class Lines
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Lines extends Collection
{
    public function asHtml(): string
    {
        return $this->map(fn (Line $line) => $line->toHtml());
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->items);
    }
}
