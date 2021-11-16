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
}
