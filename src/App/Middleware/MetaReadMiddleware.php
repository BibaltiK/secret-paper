<?php declare(strict_types=1);

namespace App\Middleware;

use App\Model\Meta;
use App\Service\MetaHydrator;
use App\Service\MetaReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MetaReadMiddleware implements MiddlewareInterface
{
    public function __construct(
        private MetaHydrator $hydrator,
        private MetaReader $reader,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $secretName = $request->getAttribute('secretLink');
        $meta = $this->reader->read($secretName);
        $meta = $this->hydrator->hydrateArray($meta);

        return $handler->handle($request->withAttribute(Meta::class, $meta));
    }
}
