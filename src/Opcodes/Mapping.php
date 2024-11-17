<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Zbkm\Evm\Exceptions\InvalidOpcode;
use Zbkm\Evm\Interfaces\IOpcode;

class Mapping
{
    /**
     * @param string $opcode opcode
     * @return IOpcode
     */
    public static function getExecutor(string $opcode): string
    {
        if (!array_key_exists($opcode, self::getOpcodeMapping())) {
            throw new InvalidOpcode();
        }

        return self::getOpcodeMapping()[$opcode];
    }

    /**
     * Return mapping for opcodes
     *
     * @return array<string, string>
     */
    public static function getOpcodeMapping(): array
    {
        static $mapping = [];
        if (!empty($mapping)) {
            return $mapping;
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__));
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php'
                && !in_array($file->getFilename(), ["BaseOpcode.php", "Mapping.php"])) {
                $class = "Zbkm\\Evm\\Opcodes" . str_replace(
                        ['/', '.php'],
                        ['\\', ''],
                        substr($file->getPathname(), strlen(__DIR__))
                    );

                $opcode = $class::getOpcode();
                $mapping[$opcode] = $class;
            }
        }

        return $mapping;
    }

}