<?php declare(strict_types=1);

namespace App\Service;

use App\Model\Meta;
use Laminas\Config\Writer\Json;

class MetaWriter
{
    use MetaJsonTrait;
    use DirectoryStructurTrait;

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
