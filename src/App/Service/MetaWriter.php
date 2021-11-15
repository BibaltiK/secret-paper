<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Config\Config;
use Laminas\Config\Writer\Json;

class MetaWriter
{
    public function __construct(
        private Json $writer
    ) {
    }

    public function write(string $file, Config $metaData): void
    {
        $this->write($file, $metaData);
    }
}
