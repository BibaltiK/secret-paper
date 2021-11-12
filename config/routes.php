<?php declare(strict_types=1);

return static function (Mezzio\Application $app): void {
    $app->get(
        '/',
        [
            App\Handler\IndexHandler::class,
        ],
        App\Handler\IndexHandler::class
    );
};
