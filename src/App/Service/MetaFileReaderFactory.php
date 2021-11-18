<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Config\Reader\Json;
use Psr\Container\ContainerInterface;

class MetaFileReaderFactory
{
    public function __invoke(ContainerInterface $container): MetaFileReader
    {
        $config = $container->get('config');
        $json = $container->get(Json::class);

        $config = $config['upload'];
        $path = ROOT_DIR . DIRECTORY_SEPARATOR . trim($config['path'], '/');

        return new MetaFileReader($path, $json);
    }
}
