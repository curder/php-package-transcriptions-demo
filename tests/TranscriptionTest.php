<?php
namespace Tests;

use Curder\PhpPackageTranscriptionsDemo\Line;
use PHPUnit\Framework\TestCase;
use Curder\PhpPackageTranscriptionsDemo\Transcription;

class TranscriptionTest extends TestCase
{
    /** @test */
    public function it_can_load_a_vtt_file() : void
    {
        $file = __DIR__.'/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringContainsString('Here is a', $transcription);
        $this->assertStringContainsString('example of a VTT file.', $transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_line_objects(): void
    {
        $file = __DIR__.'/stubs/basic-example.vtt';
        $lines = Transcription::load($file)->lines();

        $this->assertCount(2, $lines);
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file(): void
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transaction = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transaction);
    }
}
