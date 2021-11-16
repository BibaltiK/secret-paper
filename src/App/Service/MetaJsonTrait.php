<?php declare(strict_types=1);

namespace App\Service;

use App\Model\Meta;
use Laminas\Config\Config;

trait MetaJsonTrait
{
    private function hydrateJson(Meta $meta): Config
    {
        $config = new Config([], true);
        $config->clientFilename = $meta->getClientFilename();
        $config->serverFilename = $meta->getServerFilename();
        $config->mediaType = $meta->getMediaType();
        $config->password = $meta->getPassword();

        return $config;
    }

    private function extractJson(Config $json): Meta
    {
        $meta = new Meta();
        $meta->setClientFilename($json->get('clientFilename'))
            ->setServerFilename($json->get('serverFilename'))
            ->setMediaType('mediaType')
            ->setPassword('password');

        return $meta;
    }
}
