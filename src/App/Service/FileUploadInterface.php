<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Diactoros\UploadedFile;

interface FileUploadInterface
{
    public function uploadFile(UploadedFile $file): string;
}
