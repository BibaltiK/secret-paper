<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Config\Writer\Json;
use Psr\Container\ContainerInterface;

class MetaWriterFactory
{
    public function __invoke(ContainerInterface $container): MetaWriter
    {
        $config = $container->get('config');
        $json = $container->get(Json::class);

        $config = $config['upload'];
        $path = trim($config['path'], '/');

        return new MetaWriter($path, $json);
    }
}
