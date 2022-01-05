<?php
namespace Tests;

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
    public function it_can_convert_to_an_array_of_lines(): void
    {
        $file = __DIR__.'/stubs/basic-example.vtt';

        $this->assertCount(4, Transcription::load($file)->lines());
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file(): void
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transaction = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transaction);
        $this->assertCount(4, $transaction->lines());
    }
}
