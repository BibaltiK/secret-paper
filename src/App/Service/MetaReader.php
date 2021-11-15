<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Config\Reader\Json;

class MetaReader
{
    public function __construct(
        private Json $reader,
    ) {
    }
}
