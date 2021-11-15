<?php declare(strict_types=1);

return static function (Mezzio\Application $app): void {
    $app->get(
        '/',
        [
            App\Handler\IndexHandler::class,
        ],
        App\Handler\IndexHandler::class
    );
    $app->post(
        '/file',
        [
            App\Middleware\FileUploadValidatorMiddleware::class,
            App\Middleware\FileUploadMiddleware::class,
            App\Handler\FileUploadHandler::class,
        ],
        \App\Handler\FileUploadHandler::class
    );
    $app->get(
        '/{name:.+}',
        [
            App\Handler\FakeHandler::class,
        ],
        App\Handler\FakeHandler::class
    );
};
