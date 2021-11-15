<?php declare(strict_types=1);

namespace App\Service;

trait DirectoryStructurTrait
{
    private function getDirectoryStructure(string $encodedFileName): string
    {
        $uploadFileDirectory = '';
        for ($i=0; $i<6; $i = $i+2) {
            $uploadFileDirectory .= '/' . substr($encodedFileName, $i, 2) ;
        }

        return $uploadFileDirectory . '/';
    }
}
