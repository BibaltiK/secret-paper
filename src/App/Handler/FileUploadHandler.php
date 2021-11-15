<?php declare(strict_types=1);

namespace App\Handler;

use App\Validator\FileUploadValidator;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FileUploadHandler implements RequestHandlerInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $validationMessage = $request->getAttribute(FileUploadValidator::FILE_UPLOAD_VALIDATOR_MESSAGE);

        return new HtmlResponse($this->template->render('app::index', ['fake' => 'upload']));
    }
}
