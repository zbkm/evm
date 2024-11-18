<?php
declare(strict_types=1);

namespace Opcodes;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Zbkm\Evm\Opcodes\Mapping;
use PHPUnit\Framework\TestCase;

class MappingTest extends TestCase
{
    public function testOpcodeMapper()
    {
        $mapping = [];

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("./src/opcodes/"));
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php'
                && !in_array($file->getFilename(), ["BaseOpcode.php", "Mapping.php"])) {
                $class = "Zbkm\\Evm\\Opcodes\\" . str_replace(
                        ['/', '.php'],
                        ['\\', ''],
                        substr($file->getPathname(), strlen("./src/opcodes/"))
                    );

                $opcode = $class::getOpcode();
                $mapping[$opcode] = $class;
            }
        }

        $this->assertEquals($mapping, Mapping::getOpcodeMapping());

    }
}
