<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Config\Writer\Json;
use Psr\Container\ContainerInterface;

class MetaFileWriterFactory
{
    public function __invoke(ContainerInterface $container): MetaFileWriter
    {
        $config = $container->get('config');
        $json = $container->get(Json::class);

        $config = $config['upload'];
        $path = ROOT_DIR . DIRECTORY_SEPARATOR . trim($config['path'], '/');

        return new MetaFileWriter($path, $json);
    }
}
