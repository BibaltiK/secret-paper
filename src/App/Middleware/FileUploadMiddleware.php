<?php declare(strict_types=1);

namespace App\Middleware;

use App\Service\FileUpload;
use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FileUploadMiddleware implements MiddlewareInterface
{
    public function __construct(
        private FileUpload $service,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uploadFile = $request->getAttribute(UploadedFile::class);

        if (!$uploadFile instanceof UploadedFile) {
            return $handler->handle($request);
        }

        $encodedFilename = $this->service->uploadFile($uploadFile);

        return $handler->handle($request->withAttribute(FileUpload::ENCODED_FILENAME, $encodedFilename));
    }
}
