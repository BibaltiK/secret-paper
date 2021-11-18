<?php declare(strict_types=1);

use App\Handler\FileUploadHandler;

return static function (Mezzio\Application $app): void {
    $app->get(
        '/',
        [
            App\Handler\IndexHandler::class,
        ],
        App\Handler\IndexHandler::class
    );
    $app->post(
        '/',
        [
            App\Middleware\FileUploadValidatorMiddleware::class,
            App\Middleware\FileUploadMiddleware::class,
            App\Middleware\MetaCreateMiddleware::class,
            App\Handler\FileUploadHandler::class,
        ],
        FileUploadHandler::class
    );
    $app->get(
        '/fake',
        [
            App\Handler\FakeHandler::class,
        ],
        App\Handler\FakeHandler::class
    );
    $app->get(
        '/pdf/{secretLink:.+}',
        [
            App\Middleware\SecretLinkValidatorMiddleware::class,
            App\Middleware\MetaReadMiddleware::class,
            App\Handler\PdfHandler::class,
        ],
        App\Handler\PdfHandler::class
    );
    $app->get(
        '/{secretLink:.+}',
        [
            App\Middleware\SecretLinkValidatorMiddleware::class,
            App\Middleware\MetaReadMiddleware::class,
            App\Handler\SecretLinkHandler::class,
        ],
        App\Handler\SecretLinkHandler::class
    );
};
