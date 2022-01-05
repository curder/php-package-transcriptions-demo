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

        $this->assertStringEqualsFile($file, Transcription::load($file));
    }
}
