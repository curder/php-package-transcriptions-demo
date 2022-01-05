<?php
namespace Curder\PhpPackageTranscriptionsDemo;

/**
 * Class Transcription
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Transcription
{
    protected string $file;

    public static function load(string $path): string
    {
        $instance = new static;

        $instance->file = file_get_contents($path);

        return $instance;
    }

    public function __toString(): string
    {
        return $this->file;
    }
}
