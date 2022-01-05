<?php
namespace Curder\PhpPackageTranscriptionsDemo;

/**
 * Class Line
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Line
{
    public int $position;
    public string $timestamp;
    public string $body;

    public function __construct(
        int $position,
        string $timestamp,
        string $body
    ) {
        $this->position = $position;
        $this->timestamp = $timestamp;
        $this->body = $body;
    }

    public function toAnchorTag(): string
    {
        return sprintf('<a href="?t=%s">%s</a>', $this->beginningTimestamp(), $this->body);
    }

    public function beginningTimestamp()
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }
}
