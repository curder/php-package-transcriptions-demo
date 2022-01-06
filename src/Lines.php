<?php

namespace Curder\PhpPackageTranscriptionsDemo;



use phpDocumentor\Reflection\Types\This;

/**
 * Class Lines
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Lines extends Collection
{
    public function asHtml(): string
    {
        return $this->map(fn (Line $line) => $line->toAnchorTag());
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->items);
    }
}
