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

    public static function load(string $path): self
    {
        $instance = new static;

        $instance->lines = $instance->discardsIrrelevantLines(file($path));

        return $instance;
    }

    public function lines(): array
    {
        return $this->lines;
    }

    public function __toString(): string
    {
        return implode('', $this->lines);
    }

    protected function discardsIrrelevantLines(array $lines) : array
    {
        $lines = array_map('rtrim', $lines);

        return array_filter(
            $lines,
            fn ($line) => $line !== 'WEBVTT' && $line !== '' && !is_numeric($line)
        );
    }
}
