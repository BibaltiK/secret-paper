<?php declare(strict_types=1);

namespace App\Service;

use App\Model\Meta;
use Laminas\Config\Writer\Json;

class MetaFileWriter
{
    use MetaFileJsonTrait;
    use DirectoryStructureTrait;

    public function __construct(
        private string $dataDirectory,
        private Json $writer
    ) {
    }

    public function write(Meta $meta): void
    {
        $directory = $this->dataDirectory . $this->getDirectoryStructure($meta->getServerFilename());
        $filename = $directory . DIRECTORY_SEPARATOR . $meta->getServerFilename() . '.meta';

        $json = $this->hydrateJson($meta);
        $this->writer->toFile($filename, $json);
    }

}
