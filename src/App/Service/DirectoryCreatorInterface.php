<?php declare(strict_types=1);

namespace App\Service;

interface DirectoryCreatorInterface
{
    public function createDirectoryStructureIfNotExist(string $encodedFileName): null|string;
}
