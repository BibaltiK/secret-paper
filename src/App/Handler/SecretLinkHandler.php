<?php declare(strict_types=1);

namespace App\Handler;

use App\Model\Meta;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SecretLinkHandler implements RequestHandlerInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Meta $metaFile */
        $metaFile = $request->getAttribute(Meta::class);

        return new HtmlResponse($this->template->render('app::secret', ['pdf' => $metaFile->getServerFilename()]));
    }
}
