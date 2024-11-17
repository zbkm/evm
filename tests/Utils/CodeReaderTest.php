<?php
declare(strict_types=1);

namespace Utils;

use Zbkm\Evm\Utils\CodeReader;
use PHPUnit\Framework\TestCase;

class CodeReaderTest extends TestCase
{
    public function testRead(): void
    {
        $reader = new CodeReader("604260006001F3");

        $this->assertEquals("60", $reader->current());
        $reader->next();
        $this->assertEquals("42", $reader->current());
        $reader->next();
        $this->assertEquals("60", $reader->current());
        $reader->skip(1);
        $this->assertEquals("60", $reader->current());
        $this->assertEquals("01", $reader->readAndSkip(1));
        $this->assertEquals("F3", $reader->current());
        $this->assertTrue($reader->valid());
        $reader->next();
        $this->assertFalse($reader->valid());
        $reader->rewind();
        $reader->skip(5);
        $this->assertEquals("F3", $reader->current());
    }

}
