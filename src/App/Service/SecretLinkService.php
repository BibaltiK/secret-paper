<?php declare(strict_types=1);

namespace App\Service;

class SecretLinkService
{
    use DirectoryStructureTrait;

    public function __construct(
        private string $dataDirectory,
    ) {
    }

    public function exists(string $file): bool
    {
        $file = $this->dataDirectory . $this->getDirectoryStructure($file) . $file;

        return file_exists($file);
    }
}
