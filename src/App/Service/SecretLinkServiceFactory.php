<?php declare(strict_types=1);

namespace App\Service;

use Laminas\Config\Writer\Json;
use Psr\Container\ContainerInterface;

class SecretLinkServiceFactory
{
    public function __invoke(ContainerInterface $container): SecretLinkService
    {
        $config = $container->get('config');

        $config = $config['upload'];
        $dataDirectory = ROOT_DIR . DIRECTORY_SEPARATOR . trim($config['path'], '/');

        return new SecretLinkService($dataDirectory);
    }
}
