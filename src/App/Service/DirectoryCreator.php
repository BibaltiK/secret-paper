<?php declare(strict_types=1);

namespace App\Service;

use Psr\Log\InvalidArgumentException;

use function mkdir;

class DirectoryCreator
{
    use DirectoryStructurTrait;

    public function __construct(
        private string $uploadRootDirectory,
    ) {
        $this->uploadRootDirectory = trim($this->uploadRootDirectory, '/');
    }

    public function createDirectoryStructure(string $encodedFileName): string
    {
        $uploadFileDirectory = ROOT_DIR . DS . $this->uploadRootDirectory . $this->getDirectoryStructure($encodedFileName);

        if (!mkdir($uploadFileDirectory, 0755, true)) {
            throw new InvalidArgumentException(sprintf('Can not create Directory: %s', $uploadFileDirectory));
        }
var_dump($uploadFileDirectory);die();
        return $uploadFileDirectory;
    }
}
