<?php declare(strict_types=1);

namespace App\Service;

use Psr\Container\ContainerInterface;

class DirectoryCreatorFactory
{
    public function __invoke(ContainerInterface $container): DirectoryCreator
    {
        $config = $container->get('config');

        $config = $config['upload'];
        $path = trim($config['path'], '/');

        return new DirectoryCreator($path);
    }
}
