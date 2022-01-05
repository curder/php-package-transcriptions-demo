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
        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): array
    {
        $lines = [];

        for ($i = 0, $length = count($this->lines); $i < $length; $i += 2 ) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i+1]);
        }

        return $lines;
    }

    public function __toString(): string
    {
        return implode('', $this->lines);
    }

    protected function discardInvalidLines(array $lines) : array
    {
        return array_values(array_filter($lines, static fn ($line) => Line::valid($line)));
    }
}
