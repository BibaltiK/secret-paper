<?php declare(strict_types=1);

namespace App\Service;

use Psr\Log\InvalidArgumentException;

use function mkdir;

class DirectoryCreator implements DirectoryCreatorInterface
{

    public function createDirectoryStructureIfNotExist(string $encodedFileName): string
    {
        $uploadFileDirectory = UPLOAD_DIR . $this->getDirectoryStructure($encodedFileName);

        if (!mkdir($uploadFileDirectory, 0755, true)) {
            throw new InvalidArgumentException(sprintf('Can not create Directory: %s', $uploadFileDirectory));
        }

        return $uploadFileDirectory;
    }

    private function getDirectoryStructure(string $encodedFileName): string
    {
        $uploadFileDirectory = '';
        for ($i=0; $i<6; $i = $i+2) {
            $uploadFileDirectory .= '/' . substr($encodedFileName, $i, 2) ;
        }

        return $uploadFileDirectory . '/';
    }
}
