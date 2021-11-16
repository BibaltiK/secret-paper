<?php declare(strict_types=1);

namespace App\Middleware;

use App\Service\SecretLinkService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\InvalidArgumentException;

class SecretLinkValidatorMiddleware implements MiddlewareInterface
{
    public function __construct(
        private SecretLinkService $linkService,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $secretName = $request->getAttribute('secretLink');

        if (!$this->linkService->exists($secretName)) {
            throw new InvalidArgumentException(sprintf('Invalid File %s', $secretName));
        }

        return $handler->handle($request);
    }
}
