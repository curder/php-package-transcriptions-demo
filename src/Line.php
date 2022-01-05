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

    public static function valid(string $line) : bool
    {
        return $line !== 'WEBVTT' && $line !== '' && !is_numeric($line);
    }
}
