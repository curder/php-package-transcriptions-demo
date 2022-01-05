<?php
namespace Curder\PhpPackageTranscriptionsDemo;

/**
 * Class Transcription
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Transcription
{
    protected array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $this->discardInvalidLines($lines);
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): Lines
    {
        return new Lines(array_map(
            static fn ($line) => new Line(...$line),
            array_chunk($this->lines, 3)
        ));
    }

    protected function discardInvalidLines(array $lines) : array
    {
        return array_slice(array_filter(array_map('rtrim', $lines)), 1);
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }
}
