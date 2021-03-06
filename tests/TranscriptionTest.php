<?php

namespace Tests;

use ArrayAccess;
use Curder\PhpPackageTranscriptionsDemo\Line;
use Curder\PhpPackageTranscriptionsDemo\Transcription;
use JsonSerializable;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase
{
    protected Transcription $transcription;

    public function setUp(): void
    {
        $this->transcription = Transcription::load(
            __DIR__ . '/stubs/basic-example.vtt'
        );
    }

    /** @test */
    public function it_can_load_a_vtt_file(): void
    {
        $this->assertStringContainsString('Here is a', $this->transcription);
        $this->assertStringContainsString('example of a VTT file.', $this->transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_line_objects(): void
    {
        $this->assertCount(2, $this->transcription->lines());
        $this->assertContainsOnlyInstancesOf(Line::class, $this->transcription->lines());
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file(): void
    {
        $this->assertStringNotContainsString('WEBVTT', $this->transcription);
    }

    /** @test */
    public function it_renders_the_lines_as_html(): void
    {
        $output = <<<DOC
<a href="?t=00:03">Here is an</a>
<a href="?t=00:04">example of a VTT file.</a>
DOC;

        $this->assertEquals($output, $this->transcription->lines()->asHtml());
    }

    /** @test */
    public function it_supports_array_access(): void
    {
        $lines = $this->transcription->lines();

        $this->assertInstanceOf(ArrayAccess::class, $lines);
        $this->assertInstanceOf(Line::class, $lines[0]);
    }

    /** @test */
    public function it_can_render_as_json(): void
    {
        $lines = $this->transcription->lines();

        $this->assertInstanceOf(JsonSerializable::class, $lines);
        $this->assertJson(json_encode($lines));
    }
}
