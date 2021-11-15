<?php declare(strict_types=1);

namespace App\Middleware;

use App\Validator\FileUploadValidator;
use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FileUploadValidatorMiddleware implements MiddlewareInterface
{
    public function __construct(
        private FileUploadValidator $validator,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uploadFile = $request->getUploadedFiles();

        $this->validator->setData($uploadFile);

        if (!$this->validator->isValid()) {
            return $handler->handle($request->withAttribute(FileUploadValidator::FILE_UPLOAD_VALIDATOR_MESSAGE, $this->validator->getMessages()));
        }

        return $handler->handle($request->withAttribute(UploadedFile::class, $uploadFile['uploadFile']));
    }
}
