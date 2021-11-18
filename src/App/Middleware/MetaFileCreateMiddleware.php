<?php declare(strict_types=1);

namespace App\Middleware;

use App\Model\Meta;
use App\Service\FileUpload;
use App\Service\MetaModelHydrator;
use App\Service\MetaFileWriter;
use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MetaFileCreateMiddleware implements MiddlewareInterface
{
    public function __construct(
        private MetaModelHydrator $hydrator,
        private MetaFileWriter $writer,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uploadFile = $request->getAttribute(UploadedFile::class);
        $encodedName = $request->getAttribute(FileUpload::ENCODED_FILENAME);

        if (!$uploadFile instanceof UploadedFile) {
            return $handler->handle($request);
        }

        $metaFile = $this->hydrator->hydrate($uploadFile, $encodedName);

        $this->writer->write($metaFile);

        return $handler->handle($request->withAttribute(Meta::class, $metaFile));
    }
}
