<?php declare(strict_types=1);

if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

const DS = DIRECTORY_SEPARATOR;
const PS = '.';

define('ROOT_DIR', realpath(__DIR__));

const CONFIG_DIR = ROOT_DIR . DS .'config' . DS;

require ROOT_DIR . DS . 'vendor/autoload.php';

(function () {
    /** @var Psr\Container\ContainerInterface $container */
    $container = require CONFIG_DIR . 'container.php';

    /** @var Mezzio\Application $app */
    $app = $container->get(Mezzio\Application::class);

    $factory = $container->get(Mezzio\MiddlewareFactory::class);

    (require CONFIG_DIR . 'pipeline.php')($app);
    (require CONFIG_DIR . 'routes.php')($app);

    $app->run();
})();
