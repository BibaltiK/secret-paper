<?php declare(strict_types=1);

namespace App\Service;

use App\Model\Meta;
use Laminas\Config\Reader\Json;

class MetaReader
{
    use MetaJsonTrait;
    use DirectoryStructurTrait;

    public function __construct(
        private string $dataDirectory,
        private Json $json,
    ) {
    }

    public function read(string $file): array
    {
        $filePath = $this->dataDirectory . $this->getDirectoryStructure($file);
        $file = $this->json->fromFile($filePath  . $file . '.meta');
        $file['path'] = $filePath;

        return $file;
    }
}
