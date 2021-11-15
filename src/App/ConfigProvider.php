<?php declare(strict_types=1);

namespace App;

use App\Service;
use App\Validator\Input;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Mezzio\Template\TemplateRendererInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            ConfigAbstractFactory::class => $this->getAbstractFactoryConfig(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Middleware\FileUploadMiddleware::class,

                Service\DirectoryCreator::class,
                Service\RandomStringService::class,

                Input\FileUploadInput::class,
            ],
            'factories' => [
                Handler\FakeHandler::class => ConfigAbstractFactory::class,
                Handler\FileUploadHandler::class => ConfigAbstractFactory::class,
                Handler\IndexHandler::class => ConfigAbstractFactory::class,
                Handler\SecretHandler::class => ConfigAbstractFactory::class,

                Middleware\FileUploadMiddleware::class => ConfigAbstractFactory::class,
                Middleware\FileUploadValidatorMiddleware::class => ConfigAbstractFactory::class,

                Service\FileUpload::class => ConfigAbstractFactory::class,

                Validator\FileUploadValidator::class => ConfigAbstractFactory::class,
            ],
        ];
    }

    public function getAbstractFactoryConfig(): array
    {
        return [
            Handler\FakeHandler::class => [
                TemplateRendererInterface::class,
            ],
            Handler\FileUploadHandler::class => [
                TemplateRendererInterface::class,
            ],
            Handler\IndexHandler::class => [
                TemplateRendererInterface::class,
            ],
            Handler\SecretHandler::class => [
                TemplateRendererInterface::class,
            ],

            Middleware\FileUploadMiddleware::class => [
                Service\FileUpload::class,
            ],
            Middleware\FileUploadValidatorMiddleware::class => [
                Validator\FileUploadValidator::class,
            ],

            Service\FileUpload::class => [
                Service\DirectoryCreator::class,
                Service\RandomStringService::class,
            ],

            Validator\FileUploadValidator::class => [
                Input\FileUploadInput::class,
            ],
        ];
    }
}
