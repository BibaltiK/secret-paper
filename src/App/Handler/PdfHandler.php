<?php declare(strict_types=1);

namespace App\Handler;

use App\Model\Meta;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PdfHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Meta $metaFile */
        $metaFile = $request->getAttribute(Meta::class);
        $body = new Stream($metaFile->getPath() . $metaFile->getServerFilename());

        return new Response($body, 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
