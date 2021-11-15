<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Diactoros\UploadedFile;
use Laminas\Config\Config;

class MetaCreator
{
    public function createMetaFile(UploadedFile $file, string $encodedFile)
    {
        $config = new Config([], true);
        $config->meta = [];
        $config->meta->clientFilename = $file->getClientFilename();
        $config->meta->clientMineType = $file->getClientMediaType();
    }
}
