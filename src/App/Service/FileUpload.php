<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Diactoros\UploadedFile;

class FileUpload
{
    public function __construct(
        private DirectoryCreator $directoryCreator,
        private RandomStringService $randomStringService,
    ) {
    }

    public function uploadFile(UploadedFile $file): string
    {
        $encodedFileName = $this->randomStringService->generateRandomString();

        $directory = $this->directoryCreator->createDirectoryStructure($encodedFileName);
        $directory .= $encodedFileName;

        $this->persistUpload($file, $directory);

        return $encodedFileName;
    }

    private function persistUpload(UploadedFile $file, string $encodedFile): void
    {
        $file->moveTo($encodedFile);
    }
}
