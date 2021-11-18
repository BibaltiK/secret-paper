<?php declare(strict_types=1);

namespace App\Service;

use App\Model\Meta;
use Laminas\Diactoros\UploadedFile;

class MetaModelHydrator
{
    public function hydrate(UploadedFile $file, string $encodedFile, string $password = ''): Meta
    {
        $meta = new Meta();

        $meta->setClientFilename($file->getClientFilename())
            ->setMediaType($file->getClientMediaType())
            ->setServerFilename($encodedFile)
            ->setPassword($password);

        return $meta;
    }

    public function hydrateArray(array $data): Meta
    {
        $meta = new Meta();

        $meta->setClientFilename($data['clientFilename'])
            ->setMediaType($data['mediaType'])
            ->setServerFilename($data['serverFilename'])
            ->setPassword($data['password'])
            ->setPath($data['path']);

        return $meta;
    }

    public function extract(Meta $meta): array
    {
        return [
            'clientFilename' => $meta->getClientFilename(),
            'serverFilename' => $meta->getServerFilename(),
            'mediaType' => $meta->getMediaType(),
            'password' => $meta->getPassword(),
        ];
    }
}
