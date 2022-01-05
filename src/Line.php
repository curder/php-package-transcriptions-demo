<?php
namespace Curder\PhpPackageTranscriptionsDemo;

/**
 * Class Line
 *
 * @package \Curder\PhpPackageTranscriptionsDemo
 */
class Line
{
    public string $timestamp;
    public string $body;

    public function __construct(string $timestamp, string $body)
    {
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

    public static function valid(string $line) : bool
    {
        return $line !== 'WEBVTT' && $line !== '' && !is_numeric($line);
    }
}
