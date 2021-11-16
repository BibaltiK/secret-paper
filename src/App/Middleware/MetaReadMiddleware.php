<?php declare(strict_types=1);

namespace App\Middleware;

use App\Service\MetaHydrator;
use App\Service\MetaReader;
use App\Service\MetaWriter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MetaReadMiddleware implements MiddlewareInterface
{
    public function __construct(
        private MetaHydrator $hydrator,
        private MetaReader $writer,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
    }
}
